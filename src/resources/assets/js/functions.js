
csrfToken = function( ){
    return $('meta[name="csrf-token"]').attr('content');
}
      

$.fn.startLoading = function( ){
    this.addClass('loading');
    return this;
    //initNavs(this);
  };
  
  $.fn.stopLoading = function( ){
    this.removeClass('loading').addClass("loaded");
    return this;
    //initNavs(this);
  };
  
  
Object.defineProperty(Object.prototype, "dotSet", {

    enumerable: false,
    
    value: function (key, value) {
      if(key.includes(".")){
        var arr = key.split(".");
        var first = arr.shift();
        var rest=arr.join(".");
        if (this[first] === undefined) {
          this[first] = {};
        }
  
        this[first].dotSet(rest,value);
        
      }else{
        if (this[key] === undefined) {
          this[key] = {};
        }
        this[key] = value;
      }
  
    }
  
  });
  
  
  Object.defineProperty(Object.prototype, "dotGet", {
  
    enumerable: false,
    
    value: function (key, def) {
  
      if(key.includes(".")){
        var arr = key.split(".");
        var first = arr.shift();
        var rest=arr.join(".");
        if (this[first] === undefined) {
          this[first] = {};
        }
  
        return this[first].dotGet(rest,def);
        
      }else{
        if (this[key] === undefined) {
          return def;
        }
        return this[key];
      }
    }
  
  });
  