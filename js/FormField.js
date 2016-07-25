// CLASS FIELD
function Field(FieldId, FieldLabel, Required){
    this.FieldId=FieldId;
    this.PostId=FieldId;
    this.FieldLabel=FieldLabel;
    this.Required=Required;
    this.FieldType="no_restriction";
}

function Field(FieldId, PostId, FieldLabel, Required){
    this.FieldId=FieldId;
    this.PostId=PostId;
    this.FieldLabel=FieldLabel;
    this.Required=Required;
    this.FieldType="no_restriction";
}

function Field(FieldId, PostId, FieldLabel, FieldType, Required){
    this.FieldId=FieldId;
    this.PostId=PostId;
    this.FieldLabel=FieldLabel;
    this.Required=Required;
    this.FieldType=FieldType;
}

Field.prototype.getFieldId=function(){
    return this.FieldId;
};
    
Field.prototype.getFieldLabel=function(){
    return this.FieldLabel;
};

Field.prototype.getFieldPostId=function(){
    var sId=this.PostId;
    if(sId==undefined)
        this.PostId=this.FieldId;
    return this.PostId;
};

Field.prototype.isRequired=function(){
    return this.Required;
};

Field.prototype.getFieldType=function(){
    return this.FieldType;
};

Field.prototype.getFieldValue=function(){
    var type=$(this.FieldId).attr("type");
    var val=$(this.FieldId).val();
    if(type=="radio"){
        val=$("input:radio[name="+this.PostId+"]:checked" ).val();
    } else if(type=="checkbox"){
        val=$(this.FieldId).prop("checked");
    }
    //alert(type+" "+this.FieldId+" "+val);
    return val;
};


// CLASS FORM
function Form(){
    this.Fields=Array();
};

Form.prototype.addField=function(Field){
    this.Fields.push(Field);
};

Form.prototype.getField=function(FieldId){
    var F=null;
    for(i=0;i<this.Fields.length;++i){
        if(this.Fields[i].getFieldId()==FieldId){
            F=this.Fields[i];
        }
    }
    return F;
};

Form.prototype.validateFields=function(){
    var i=0;
    for(i=0;i<this.Fields.length;++i){
        if(this.Fields[i].isRequired()){
            if(this.Fields[i].getFieldValue().length == 0 || this.Fields[i].getFieldValue()==null){
                alert("Debe proporcionar un valor para el campo: "+this.Fields[i].getFieldLabel());
                this.focusField(this.Fields[i].getFieldId());
                return false;
            }
        } if(this.Fields[i].getFieldValue()!=null && this.Fields[i].getFieldValue().length > 0){
            if(!validateValueType(this.Fields[i].getFieldValue(), this.Fields[i].getFieldType())){
                alert("El valor del campo "+this.Fields[i].getFieldLabel()+" no es válido");
                this.focusField(this.Fields[i].getFieldId());
                return false;
            }
        }
        
    }
    return true;
};

function focusField(FieldId){
    window.setTimeout(function () { 
        $(FieldId).focus();
    },5);
};

Form.prototype.focusField=focusField;


Form.prototype.getFieldsPostArray=function(){
    var i=0;
    var FieldsMap=Array();
    for(i=0;i<this.Fields.length;++i){
        var id=this.Fields[i].getFieldPostId();
        var val=this.Fields[i].getFieldValue();
        pushFieldValue(FieldsMap, id, val);
    }
    return FieldsMap;
};

Form.prototype.getFields=function(){
    return this.Fields;
};


//USEFUL FUNCTIONS
function pushFieldValue(fieldsArray, fieldName, fieldValue){
    //alert(fieldName+" - "+fieldValue);
    fieldsArray.push({name: fieldName, value: fieldValue});
}

// ENTRY VALIDATING

function validateValueType(value, type){
    var Validators={
        iso_date: /^\d{4}-(0[1-9]|1[0,1,2])-(0[1-9]|[1,2][0-9]|3[0,1])$/i,
        rev_iso_date: /^(0[1-9]|[1,2][0-9]|3[0,1])-(0[1-9]|1[0,1,2])-\d{4}$/i,
        email: /^([0-9a-zA-Z]+([_.-]?[0-9a-zA-Z]+)*@[0-9a-zA-Z]+[0-9,a-z,A-Z,.,-]*(.){1}[a-zA-Z]{2,4})+$/i,
        integer: /^-?[0-9]+$/i, 
        unsigned: /^[0-9]+$/i,
        decimal: /^-?(\d)+(\.(\d)+)?$/i,
        unsigned_decimal: /^(\d)+(\.(\d)+)?$/i,
        rfc_moral: /^[a-z]{3}(\d){6}.{3}$/i,
        rfc_physic: /^[a-z]{4}(\d){6}(.{3})?$/i,
        alpha: /^[áéíóúña-z ]+$/i,
        alpha_no_space: /^[áéíóúña-z]+$/i,
        alpha_num: /^[áéíóúña-z0-9 ]+$/i,
        alpha_num_no_space: /^[áéíóúña-z0-9]+$/i,
        no_restriction: /^.*$/i,
        nss_number: /^\d{11}$/i,
        curp: /^[a-z]{4}(\d){6}[h|m][a-z]{5}([0-9]|[a-z]){1}\d$/i,
        phone: /^\d{10}$/i,
        bank_account: /^\d{10}$/i,
        card_number: /^\d{16}$/i,
        string_symbols: /^[áéíóúña-z0-9 \._-]+$/i,
        variable: /^[a-z0-9_]+$/i
    };
    
    return Validators[type].test(value);
    
}

