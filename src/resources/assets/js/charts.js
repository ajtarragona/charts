if(!window.$) window.$ = window.jQuery = require('jquery');
// if(!window.Popper)  window.Popper = require('popper.js');


require('./functions');

import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels';
import collect from 'collect.js';

Chart.register(ChartDataLabels);

window.Chart = Chart;
window.ChartDataLabels = ChartDataLabels;
window.Chart.defaults.font.size = 14;
window.Chart.defaults.font.family = 'Montserrat, sans-serif';



var tgnchartdefaults = {
	async: false,
	refresh_rate: 0,
	url: false,
	preloader:true,
};

function TgnChartClass(canvas, settings){

    this.$canvas=canvas;
    this.id=this.$canvas.attr('id');
	this.$container=canvas.closest('.chart-container');
	this.chart_options=[];
    
	this.settings = $.extend(true, {}, tgnchartdefaults, this.$canvas.data()); 
    // if(this.settings.async)  console.log("DATA",this.$canvas.data());
    // delete this.settings.
    
    if(settings) this.settings = $.extend(true, this.settings, settings);
    // if(this.settings.async) al('TgnChartClass',this.settings);
    
    // console.log('TgnChartClass',this, this.settings);
        
    this.datasets=[];
    this.labels=[];
    this.refresh_counter=0;
    
	this.init = function(){
        var o=this;

        // if(!this.settings.async && this.settings.datasets){
            
        // }

       

    //    al('TgnChartClass',this);
    
    // var chart_options=this.settings.options;
   this.prepareOptions(this.settings.options);
   if(!this.settings.async) this.prepareData(this.settings.datasets);
    // console.log('options', chart_options);
        // console.log('this.labels',this.labels);
       this.chart = new Chart(
            this.$canvas[0],
            {
                type: this.settings.type,
                data: {
                    labels: this.labels,
                    datasets: this.datasets,
                },
                options: this.chart_options
            }
        );


        if(this.settings.async){
            this.loadData();

            if(this.settings.refresh_rate){
                setInterval(function () {
                    if(!document.hidden) o.loadData();

                }, this.settings.refresh_rate * 1000 );

            }
        }

        
        
    }

	
	this.prepareOptions = function(options){
        var o=this;
        // al(this.settings.type,options);
        var suffix_global=options.dotGet('suffix');
        var prefix_global=options.dotGet('prefix');
        
        if($.inArray(this.settings.type, ["pie","doughnut","radar","polarArea"]) < 0){
            var suffix=options.dotGet('scales.y.ticks.suffix');
            var horizontal = options.dotGet('horizontal',false);
            
            // console.log( options.dotGet('plugins.title.text'), horizontal, suffix , suffix_global);

            if(suffix || suffix_global){
                options.dotSet('scales.y.ticks.callback', function(value, index, ticks){
                    return value + ''+ (suffix?suffix:(horizontal?'':suffix_global));
                });
            }
    
            var prefix=options.dotGet('scales.y.ticks.prefix');
            if(prefix || prefix_global){
                options.dotSet( 'scales.y.ticks.callback', function(value, index, ticks){
                    return (prefix?prefix:(horizontal?'':prefix_global))+''+value;
                });
            }

            var suffix2=options.dotGet('scales.x.ticks.suffix');
            if(suffix2 || suffix_global ){
                options.dotSet( 'scales.x.ticks.callback', function(value, index, ticks){
                    return value + ''+ (suffix2?suffix2:(horizontal?suffix_global:''));
                });
            }
            
            var prefix2=options.dotGet('scales.x.ticks.prefix');
            if(prefix2 || prefix_global){
                options.dotSet( 'scales.x.ticks.callback', function(value, index, ticks){
                    return (prefix2?prefix2:(horizontal?suffix_global:''))+''+value;
                });
            }
        }

        var suffix3=options.dotGet('plugins.tooltip.suffix');
        var prefix3=options.dotGet('plugins.tooltip.prefix');

        // console.log('tooltip');
        // console.log(this.settings.type,suffix3,prefix3,suffix_global,prefix_global);

        if(suffix3 || prefix3 || suffix_global || prefix_global){
            options.dotSet( 'plugins.tooltip.callbacks.label', function(context){
                let label = context.dataset.label || '';
                // console.log('plugins.tooltip.callbacks.label',context);
                if (label) {
                    label += ': ';
                }
                if(o.settings.type=="bubble"){
                    var r = (prefix3?prefix3:(prefix_global??'')) + '' + context.raw.r + '' + (suffix3?suffix3:(suffix_global??''));
                   
                    label += "(" + context.raw.x + ", "+ context.raw.y + ", " + r +")";
                    
                }else if (context.formattedValue !== null) {
                    label += (prefix3?prefix3:(prefix_global??'')) + '' + context.formattedValue + '' + (suffix3?suffix3:(suffix_global??''));
                    
                }
                return label;
            });
        }

        //lo mismo en datalabels, miro prefijo, sufijo y el contenido de la label

         
        var datalabels=options.dotGet('plugins.datalabels');
        if(datalabels){
            
            options = o.addFormatterToDatalabel(options, 'plugins.datalabels');
            // console.log(datalabels.labels);
            if(datalabels.labels){
                collect(datalabels.labels).each((datalabel, key) => {
                    // console.log(key);
                    options = o.addFormatterToDatalabel(options, 'plugins.datalabels.labels.'+key);
                });
            }
        }
       
        this.chart_options= options;
        return options;
    }

    this.addFormatterToDatalabel = function(options, path){
        var o= this;
        // console.log('addFormatterToDatalabel',this.id,path);
        var datalabel=options.dotGet(path);
        var suffix_global=options.dotGet('suffix');
        var prefix_global=options.dotGet('prefix');
        var suffix=options.dotGet(path+'.suffix');
        var prefix=options.dotGet(path+'.prefix');

        options.dotSet( path+'.formatter', function(value, context){
            var val; 
            var islabel=false;
            if(datalabel.content && datalabel.content=='label'){
                // console.log('datalabel.content',datalabel.content, context.chart.data, context.dataIndex);
                val = context.chart.data.labels[context.dataIndex];
                islabel=true;
            }else{
                val = value;
                // console.log('val',val);
                if($.isPlainObject(val)){
                    if(o.settings.type=="line"){
                        val=val.y ?? val;
                    }else if(o.settings.type=="bar"){
                        val = (options.dotGet('indexAxis') == 'y') ? val.y : val.x;
                    }else if(o.settings.type=="bubble"){
                        val= val.r ?? val;
                    }else if($.inArray(o.settings.type, ["pie","doughnut","radar","polarArea"]) > 0){
                        // options.dotGet('parsing.key','value');
                        val=val[options.dotGet('parsing.key','value')] ?? val;
                    }

                } 
                //  
            }
            
            // console.log(datalabel.content);
            //prefijo y sufijo solo si muestro el valor.
            return  (!islabel?(prefix?prefix:(prefix_global??'')):'') +''+val+''+ (!islabel?(suffix?suffix:(suffix_global??'')):'');
            
        });

        return options;
    }

	this.setOptions = function(options){
        options = this.prepareOptions(options);
        this.chart.options=options;
    }


	this.prepareData = function(datasets){
        var o= this;
        var chart_data=[];
        var all_labels=[];
        //lo que me llega por data lo transformo
        //si es asincroono no habrá nada y no se hará nada
        if(datasets){ 
            datasets.forEach((dataset) => {
                var data=collect(dataset.data);

                // var labels=data.pluck('label').all();
                var values=data.pluck('data').all();
                all_labels=all_labels.concat(data.pluck('label').all());
                
                var dataset_options = collect(dataset.options);
                dataset_options=dataset_options.merge({
                    label : dataset.label,
                    data: values,
                }); //hago el merge

                // si los datos tienen opciones, sobrescribo las opciones de la serie como arrays

                var optionkeys=collect();
                data.each((d)=>{
                    optionkeys=optionkeys.merge(collect(d.options).keys().all());
                });
            
                optionkeys.each((optionkey) => {
                    dataset_options.put(optionkey, data.pluck('options.'+optionkey).all());
                });

                chart_data.push(dataset_options.undot().all());
            });

        }

        this.labels=collect(all_labels).unique();

        // console.log('options',o.chart_options );

        var sort=o.chart_options.sortLabels ?? false;
        if(sort){
            if(sort=== true || sort=="asc"){
                this.labels = this.labels.sort()
            }else if(sort=="desc"){
                this.labels = this.labels.sortDesc();
            }else if(Array.isArray(sort)){
                //pueden pasarme la lista de labels
                this.labels = collect(sort);
            }
        }
        
        this.labels = this.labels.all();
        this.datasets=chart_data;
      
        
    }

    this.loadData = function(){
        var o=this;
        var url=this.settings.url;
        
        // console.log('URL',url);
        var data={};

        if(this.settings.options){
            for ( var key in this.settings.options ) {
                if(key!='plugins' && key!='scales') data[key] = this.settings.options[key];
            }

        }

        // console.log(params);
        data["_token"] = getCsrfToken();
        data["classname"] = this.settings.classname;
        
        
        if(o.settings.preloader) o.$container.addClass('loading');



        
        // al("PARAMS",data);
        
        // al(data.length);
        
    


        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            // processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN':data["_token"],
                // 'Content-Type':'application/json',
            },
            success: function(data){
                o.$container.removeClass('loading');
                o.$container.find('.error-msg').remove();
                o.setOptions(data.options);
                o.prepareData(data.datasets);
                
                o.update();
            },
            error: function(xhr){

                // al("ERROR",xhr.responseJSON.message);
                if(o.$container.find('span.error-msg').length==0){
                    o.$container.append($('<span class="error-msg"/>'));
                }
                var errormesg='Error loading Chart';
                if(xhr.responseJSON && xhr.responseJSON.message) errormesg=xhr.responseJSON.message;

                o.$container.find('.error-msg').html( errormesg );
                if(o.settings.preloader)  o.$container.removeClass('loading');
                // executeCallback(o.settings.onerror,o.$container);
            }
        });
    }

    this.randomIntFromInterval = function(min, max) { // min and max included 
        return Math.floor(Math.random() * (max - min + 1) + min)
    }

    this.update = function(){
        var o=this;
        
        //si es la primera vez o el numero de datasets ha cambiado
        // console.log('update',this.labels);
        if(this.refresh_counter==0 || this.datasets.length != o.chart.data.datasets.length  ){
            this.chart.data.datasets = this.datasets;
            this.chart.data.labels= this.labels;
        }else{
            if(this.labels.length == o.chart.data.labels.length ){
                this.labels.forEach((label, i) => {
                    o.chart.data.labels[i]=label;
                });
            }else{
                o.chart.data.labels=this.labels;
            }
            // console.log(this.datasets);
            //se supone que los datasets tienen el mismo tamaño
            // console.log(this.datasets);
            this.datasets.forEach((dataset, i) => {
                // var ds=collect(dataset);

                // console.log(dataset);
                // console.log(ds);
                Object.keys(dataset).forEach(key => {
                    // console.log(key, dataset[key]);
                    o.chart.data.datasets[i][key]=dataset[key];
                });
                  
                
               
                // dataset.data.forEach((value, j)=>{
                //     o.chart.data.datasets[i].data[j]=value;
                // });

                // console.log('dataset',dataset);
                // dataset.forEach((value, key) => {
               
                //     if(key!="data" && key!="label")
                // });
            
               
                
                //modificar las opciones de cada valor del dataset
                // dataset.data.push(data);
            });

        }

        this.refresh_counter++;
        this.chart.update();
        this.chart.resize();

    }
       
    
}


// console.log("HOLA");
$.fn.tgnChart = function( settings ){
    // console.log("HOLA2");
    return this.each(function(){
        // console.log("HOLA3");
        var chart=new TgnChartClass($(this), settings);
        chart.init();
        // console.log("CHARTaaaa",chart);
        // return chart;
    });
};
