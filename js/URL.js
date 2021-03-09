// JavaScript Document

function buildURL(id,base_dir,page,parameters){
	return (`${base_dir}/${page}?id=${parameters.resourceId}` );
}

function getURL(type){
	
	let id = Date.now();
	let base_dir = home;
	let page = type;
	let parameters = {resourceId: id};
	
	return buildURL(id,base_dir,page,parameters);
}
