Array.prototype.inArray = function(comparer, element) {
    for(var i=0; i < this.length; i++) {
        if(comparer(this[i], element)) return true;
    }
    return !Boolean(element);
};

Array.prototype.refInArray = function(element){
    for(var i=0; i < this.length; i++) {
        if(this[i] == element) return true;
    }
    return false;
};

Array.prototype.pushIfNotExist = function(element, comparer) {
    if (!this.inArray(comparer, element)) {
        this.push(element);
    }
};

Array.prototype.removeIfExist = function(element, comparer) {
    if (this.inArray(comparer, element)) {
        this.;
    }
};

Array.prototype.pushIfNoNull = function(element){
    if(element !== null){
        this.push(element);
    }
};

Array.prototype.pushCroissant = function(element, comparer, binCroissant){
    for(let i = 0; i < this.length; i++){
        if(comparer(this[i], element)){
            this.splice(i,0,element);
            return;
        }
    }
    this.push(element);
};