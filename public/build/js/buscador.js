"use strict";function iniciarApp(){buscarFecha()}function buscarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const n=e.target.value;window.location="?fecha="+n})}document.addEventListener("DOMContentLoaded",(function(){iniciarApp()}));