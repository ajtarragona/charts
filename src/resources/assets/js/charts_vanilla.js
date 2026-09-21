import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels';
import collect from 'collect.js';

Chart.register(ChartDataLabels);

window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;
window.Chart.defaults.font.size = 14;
window.Chart.defaults.font.family = 'sans-serif';

const tgnchartdefaults = {
    async: false,
    refresh_rate: 0,
    url: false,
    preloader: true,
};

class TgnChart {
   constructor(canvas, settings = {}) {
        this.canvas = canvas;
        this.id = this.canvas.id;
        this.container = this.canvas.closest('.chart-container');
        this.chart_options = [];
        
        const datasetAttrs = Object.assign({}, this.canvas.dataset);
        
        this.settings = Object.assign({}, tgnchartdefaults, datasetAttrs, settings);
        
        // Parsear options y datasets si vienen como string desde los data-* attributes
        if (typeof this.settings.options === 'string') {
            try { this.settings.options = JSON.parse(this.settings.options); } 
            catch (e) { this.settings.options = {}; }
        }
        if (typeof this.settings.datasets === 'string') {
            try { this.settings.datasets = JSON.parse(this.settings.datasets); } 
            catch (e) { this.settings.datasets = []; }
        }

        if (typeof this.settings.async === 'string') {
            this.settings.async = this.settings.async === 'true';
        }
        if (typeof this.settings.refresh_rate === 'string') {
            this.settings.refresh_rate = parseFloat(this.settings.refresh_rate) || 0;
        }
        if (typeof this.settings.preloader === 'string') {
            this.settings.preloader = this.settings.preloader === 'true';
        }

        this.datasets = [];
        this.labels = [];
        this.refresh_counter = 0;
    }

    getCsrfToken() {
        const meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    // Métodos dotGet y dotSet adaptados como métodos de ayuda
    dotGet(obj, key, def) {
        if (key.includes('.')) {
            const arr = key.split('.');
            const first = arr.shift();
            const rest = arr.join('.');
            if (obj[first] === undefined) {
                obj[first] = {};
            }
            return this.dotGet(obj[first], rest, def);
        } else {
            if (obj[key] === undefined) {
                return def;
            }
            return obj[key];
        }
    }

    dotSet(obj, key, value) {
        if (key.includes('.')) {
            const arr = key.split('.');
            const first = arr.shift();
            const rest = arr.join('.');
            if (obj[first] === undefined) {
                obj[first] = {};
            }
            this.dotSet(obj[first], rest, value);
        } else {
            if (obj[key] === undefined) {
                obj[key] = {};
            }
            obj[key] = value;
        }
    }

    init() {
        const o = this;

        this.prepareOptions(this.settings.options);
        if (!this.settings.async) {
            this.prepareData(this.settings.datasets);
        }

        this.chart = new Chart(this.canvas, {
            type: this.settings.type,
            data: {
                labels: this.labels,
                datasets: this.datasets,
            },
            options: this.chart_options
        });

        if (this.settings.async) {
            this.loadData();

            if (this.settings.refresh_rate) {
                setInterval(() => {
                    if (!document.hidden) o.loadData();
                }, this.settings.refresh_rate * 1000);
            }
        }
    }

    prepareOptions(options) {
        const o = this;
        // Aseguramos que options sea un objeto plano operable
        if (!options) options = {};
        
        const suffix_global = this.dotGet(options, 'suffix');
        const prefix_global = this.dotGet(options, 'prefix');
        
        const nonAxisTypes = ["pie", "doughnut", "radar", "polarArea"];
        if (!nonAxisTypes.includes(this.settings.type)) {
            const suffix = this.dotGet(options, 'scales.y.ticks.suffix');
            const horizontal = this.dotGet(options, 'horizontal', false);
            
            if (suffix || suffix_global) {
                this.dotSet(options, 'scales.y.ticks.callback', function(value) {
                    return value + '' + (suffix ? suffix : (horizontal ? '' : suffix_global));
                });
            }
    
            const prefix = this.dotGet(options, 'scales.y.ticks.prefix');
            if (prefix || prefix_global) {
                this.dotSet(options, 'scales.y.ticks.callback', function(value) {
                    return (prefix ? prefix : (horizontal ? '' : suffix_global)) + '' + value;
                });
            }

            const suffix2 = this.dotGet(options, 'scales.x.ticks.suffix');
            if (suffix2 || suffix_global) {
                this.dotSet(options, 'scales.x.ticks.callback', function(value) {
                    return value + '' + (suffix2 ? suffix2 : (horizontal ? suffix_global : ''));
                });
            }
            
            const prefix2 = this.dotGet(options, 'scales.x.ticks.prefix');
            if (prefix2 || prefix_global) {
                this.dotSet(options, 'scales.x.ticks.callback', function(value) {
                    return (prefix2 ? prefix2 : (horizontal ? suffix_global : '')) + '' + value;
                });
            }
        }

        const suffix3 = this.dotGet(options, 'plugins.tooltip.suffix');
        const prefix3 = this.dotGet(options, 'plugins.tooltip.prefix');

        if (suffix3 || prefix3 || suffix_global || prefix_global) {
            this.dotSet(options, 'plugins.tooltip.callbacks.label', function(context) {
                let label = context.dataset.label || '';
                if (label) {
                    label += ': ';
                }
                if (o.settings.type === "bubble") {
                    const r = (prefix3 ? prefix3 : (prefix_global ?? '')) + '' + context.raw.r + '' + (suffix3 ? suffix3 : (suffix_global ?? ''));
                    label += "(" + context.raw.x + ", " + context.raw.y + ", " + r + ")";
                } else if (context.formattedValue !== null) {
                    label += (prefix3 ? prefix3 : (prefix_global ?? '')) + '' + context.formattedValue + '' + (suffix3 ? suffix3 : (suffix_global ?? ''));
                }
                return label;
            });
        }

        const datalabels = this.dotGet(options, 'plugins.datalabels');
        if (datalabels) {
            options = o.addFormatterToDatalabel(options, 'plugins.datalabels');
            if (datalabels.labels) {
                collect(datalabels.labels).each((datalabel, key) => {
                    options = o.addFormatterToDatalabel(options, 'plugins.datalabels.labels.' + key);
                });
            }
        }
       
        this.chart_options = options;
        return options;
    }

    addFormatterToDatalabel(options, path) {
        const o = this;
        const datalabel = this.dotGet(options, path);
        const suffix_global = this.dotGet(options, 'suffix');
        const prefix_global = this.dotGet(options, 'prefix');
        const suffix = this.dotGet(options, path + '.suffix');
        const prefix = this.dotGet(options, path + '.prefix');

        this.dotSet(options, path + '.formatter', function(value, context) {
            let val; 
            let islabel = false;
            
            if (datalabel && datalabel.content && datalabel.content === 'label') {
                val = context.chart.data.labels[context.dataIndex];
                islabel = true;
            } else {
                val = value;
                if (val !== null && typeof val === 'object' && val.constructor === Object) {
                    const nonAxisTypes = ["pie", "doughnut", "radar", "polarArea"];
                    if (o.settings.type === "line") {
                        val = val.y ?? val;
                    } else if (o.settings.type === "bar") {
                        val = (o.dotGet(options, 'indexAxis') === 'y') ? val.y : val.x;
                    } else if (o.settings.type === "bubble") {
                        val = val.r ?? val;
                    } else if (nonAxisTypes.includes(o.settings.type)) {
                        const parsingKey = o.dotGet(options, 'parsing.key', 'value');
                        val = val[parsingKey] ?? val;
                    }
                } 
            }
            
            return (!islabel ? (prefix ? prefix : (prefix_global ?? '')) : '') + '' + val + '' + (!islabel ? (suffix ? suffix : (suffix_global ?? '')) : '');
        });

        return options;
    }

    setOptions(options) {
        options = this.prepareOptions(options);
        this.chart.options = options;
    }

    prepareData(datasets) {
        let chart_data = [];
        let all_labels = [];
        
        if (datasets) { 
            datasets.forEach((dataset) => {
                const data = collect(dataset.data);
                const values = data.pluck('data').all();
                all_labels = all_labels.concat(data.pluck('label').all());
                
                let dataset_options = collect(dataset.options);
                dataset_options = dataset_options.merge({
                    label: dataset.label,
                    data: values,
                });

                let optionkeys = collect();
                data.each((d) => {
                    if (d.options) {
                        optionkeys = optionkeys.merge(collect(d.options).keys().all());
                    }
                });
            
                optionkeys.each((optionkey) => {
                    dataset_options.put(optionkey, data.pluck('options.' + optionkey).all());
                });

                chart_data.push(dataset_options.undot().all());
            });
        }

        this.labels = collect(all_labels).unique();

        const sort = this.chart_options.sortLabels ?? false;
        if (sort) {
            if (sort === true || sort === "asc") {
                this.labels = this.labels.sort();
            } else if (sort === "desc") {
                this.labels = this.labels.sortDesc();
            } else if (Array.isArray(sort)) {
                this.labels = collect(sort);
            }
        }
        
        this.labels = this.labels.all();
        this.datasets = chart_data;
    }

    loadData() {
        const o = this;
        const url = this.settings.url;
        const data = {};

        if (this.settings.options) {
            for (let key in this.settings.options) {
                if (key !== 'plugins' && key !== 'scales') {
                    data[key] = this.settings.options[key];
                }
            }
        }

        const csrfToken = this.getCsrfToken();
        data["_token"] = csrfToken;
        data["classname"] = this.settings.classname;
        
        if (o.settings.preloader && o.container) {
            o.container.classList.add('loading');
        }

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data)
        })
        .then(async response => {
            const json = await response.json();
            if (!response.ok) {
                throw json;
            }
            return json;
        })
        .then(data => {
            if (o.container) {
                o.container.classList.remove('loading');
                const errorMsg = o.container.querySelector('.error-msg');
                if (errorMsg) errorMsg.remove();
            }
            o.setOptions(data.options);
            o.prepareData(data.datasets);
            o.update();
        })
        .catch(async err => {
            if (o.container) {
                if (!o.container.querySelector('span.error-msg')) {
                    const span = document.createElement('span');
                    span.className = 'error-msg';
                    o.container.appendChild(span);
                }
                let errormesg = 'Error loading Chart';
                if (err && err.message) errormesg = err.message;

                o.container.querySelector('.error-msg').textContent = errormesg;
                if (o.settings.preloader) o.container.classList.remove('loading');
            }
        });
    }

    randomIntFromInterval(min, max) { 
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    update() {
        const o = this;
        
        if (this.refresh_counter === 0 || this.datasets.length !== o.chart.data.datasets.length) {
            this.chart.data.datasets = this.datasets;
            this.chart.data.labels = this.labels;
        } else {
            if (this.labels.length === o.chart.data.labels.length) {
                this.labels.forEach((label, i) => {
                    o.chart.data.labels[i] = label;
                });
            } else {
                o.chart.data.labels = this.labels;
            }

            this.datasets.forEach((dataset, i) => {
                Object.keys(dataset).forEach(key => {
                    o.chart.data.datasets[i][key] = dataset[key];
                });
            });
        }

        this.refresh_counter++;
        this.chart.update();
        this.chart.resize();
    }
}

// Plugin opcional de jQuery por si mantienes llamadas con .tgnChart()
if (window.jQuery) {
    window.jQuery.fn.tgnChart = function(settings) {
        return this.each(function() {
            const chart = new TgnChartClass(this, settings);
            chart.init();
        });
    };
}

window.TgnChart = TgnChart;

export default TgnChart;