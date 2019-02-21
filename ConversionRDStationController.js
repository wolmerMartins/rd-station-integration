class ConversionRDStationController {
    constructor(conversionId, registerForm) {
    	this._isValidated = false;
        this._form = null;
        this._conversionId = conversionId;
        this._registerForm = registerForm;
        this._body = document.getElementsByTagName("body")[0];
        this._inputs = document.querySelectorAll("class");
        this._btnJava = document.getElementById("id");
        this._action = "ConvertToRDStationController.php";
        this.initializeInputsValues();
    }
    
    submitForm() {
    	this.form[this.form.length - 1].click();
    	let XHR = new XMLHttpRequest();
    	let FD = new FormData(this.form);
    	XHR.addEventListener("load", e => {
    		console.log(e.target.responseText);
    	});
    	XHR.addEventListener("error", e => {
    		console.log("Something goes wrong...");
    	});
    	XHR.open("POST", this.action);
    	XHR.send(FD);
    }
    
    setInputsAttributes(input, value) {
    	let inputSetted = input;
    	input.setAttribute("type", "text");
		input.setAttribute("id", value);
		input.setAttribute("name", value);
		return inputSetted;
    }
    
    generateForm() {
    	let form = document.createElement("form");
    	form.setAttribute("method", "POST");
    	let inputs = [];
    	let conversionId = document.createElement("input");
    	conversionId = this.setInputsAttributes(conversionId, "conversion_identifier");
    	conversionId.value = this.conversionId;
    	inputs.push(conversionId);
    	this.inputs.forEach(input => {
    		let add = document.createElement("input");
    		add = this.setInputsAttributes(add, input.name.replace(this.registerForm.id + ":txt", "").toLowerCase());
    		add.value = input.value;
    		inputs.push(add);
    	});
    	inputs.forEach(input => {
    		form.appendChild(input);
    	});
    	let btn = document.createElement("input");
    	btn.setAttribute("type", "submit");
    	form.appendChild(btn);
    	this.body.appendChild(form);
        this.form = form;
        this.form.addEventListener("submit", e => {
        	e.preventDefault();
        });
    }
    
    validateInputsData() {
    	let aux = 0;
    	this.inputs.forEach(input => {
    		if (input.value == "" && input.id.indexOf("some-text") == -1) {
    			this.btnJava.click();
    			aux++;
    		}
    	});
    	if (aux == 0) {
    		this.isValidated = true;
    	} 
    }

    initializeInputsValues() {
        this.validateInputsData();
        if (this.isValidated) {
	        this.generateForm();
	        this.submitForm();
	        this.body.removeChild(this.form);
	        this.btnJava.click();
       }
    }
    
    get isValidated() {
    	return this._isValidated;
    }
    
    set isValidated(isValidated) {
    	this._isValidated = isValidated;
    }

    get form() {
        return this._form;
    }

    set form(form) {
        this._form = form;
    }
    
    get conversionId() {
    	return this._conversionId;
    }
    
    set conversionId(conversionId) {
    	this._conversionId = conversionId;
    }
    
    get registerForm() {
    	return this._registerForm;
    }
    
    set registerForm(registerForm) {
    	this._registerForm = registerForm;
    }
    
    get body() {
    	return this._body;
    }
    
    set body(body) {
    	this._body = body;
    }

    get inputs() {
        return this._inputs;
    }

    set inputs(inputs) {
        this._inputs = inputs;
    }
    
    get btnJava() {
    	return this._btnJava;
    }
    
    set btnJava(btnJava) {
    	this.btnJava = btnJava;
    }

    get action() {
        return this._action;
    }

    set action(action) {
        this._action = action;
    }
}