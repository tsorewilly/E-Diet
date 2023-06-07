function get(tag){
	return document.getElementById(tag);
}

function dividetags(u, l){
	return u.value/(get(l).value * get(l).value);
}

function AddOption(Tag, inputId){
	if(get(inputId).value.indexOf(Tag.value+'~')==-1) get(inputId).value+= Tag.value+'~';
}