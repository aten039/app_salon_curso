"use strict";let paso=1;const pasoInicial=1,pasoFinal=3,cita={nombre:"",fecha:"",hora:"",servicios:[]};function iniciarApp(){mostrarSeccion(),tabs(),botonesPaginador(),paginaSiguiente(),paginaAnterior(),consultarApi(),nombreCliente(),seleccionarFecha(),seleccionarHora(),mostrarResumen()}function mostrarSeccion(){const e=document.querySelector(".mostrar");e&&e.classList.remove("mostrar");document.querySelector("#paso-"+paso).classList.add("mostrar");const t=document.querySelector(".actual");t&&t.classList.remove("actual");document.querySelector(`[data-paso="${paso}"]`).classList.add("actual")}function tabs(){document.querySelectorAll(".tabs button").forEach(e=>{e.addEventListener("click",(function(e){paso=parseInt(e.target.dataset.paso),mostrarSeccion(),botonesPaginador()}))})}function botonesPaginador(){const e=document.querySelector("#siguiente"),t=document.querySelector("#anterior");1===paso?(t.classList.add("ocultar"),e.classList.remove("ocultar")):3===paso?(e.classList.add("ocultar"),t.classList.remove("ocultar"),mostrarResumen()):(e.classList.remove("ocultar"),t.classList.remove("ocultar"))}function paginaSiguiente(){document.querySelector("#siguiente").addEventListener("click",(function(){paso>=3||(paso++,botonesPaginador(),mostrarSeccion())}))}function paginaAnterior(){document.querySelector("#anterior").addEventListener("click",(function(){paso<=1||(paso--,botonesPaginador(),mostrarSeccion())}))}async function consultarApi(){try{const e="http://localhost/api/servicios",t=await fetch(e);mostrarServicios(await t.json())}catch(e){console.log(e)}}function mostrarServicios(e){e.forEach(e=>{const{id:t,nombre:o,precio:n}=e,a=document.createElement("P");a.classList.add("nombre-servicio"),a.textContent=o;const c=document.createElement("P");c.classList.add("precio-servicio"),c.textContent="$"+n;const r=document.createElement("DIV");r.classList.add("servicio"),r.dataset.idServicio=t,r.onclick=function(){seleccionarServicios(e)},r.appendChild(a),r.appendChild(c),document.querySelector("#servicios").appendChild(r)})}function seleccionarServicios(e){const{id:t}=e,{servicios:o}=cita,n=document.querySelector(`[data-id-servicio="${t}"]`);o.some(t=>t.id===e.id)?(cita.servicios=o.filter(t=>t.id!=e.id),n.classList.remove("seleccionado")):(cita.servicios=[...o,e],n.classList.add("seleccionado"))}function nombreCliente(){const e=document.querySelector("#nombre").value;cita.nombre=e}function seleccionarFecha(){document.querySelector("#fecha").addEventListener("input",e=>{const t=new Date(e.target.value).getUTCDay();[6,0].includes(t)?(e.target.value="",mostrarAlertas("fines de semana no permitidos","error",".formulario")):cita.fecha=e.target.value})}function seleccionarHora(){document.querySelector("#hora").addEventListener("input",(function(e){const t=e.target.value.split(":");t[0]>=20||t[0]<8?(mostrarAlertas("hora no valida","error",".formulario"),e.target.value=""):cita.hora=e.target.value}))}function mostrarAlertas(e,t,o,n=!0){const a=document.querySelector(".alerta");a&&a.remove();const c=document.createElement("DIV");c.textContent=e,c.classList.add(t);const r=document.createElement("DIV");r.classList.add("alerta"),r.appendChild(c);document.querySelector(o).appendChild(r),n&&setTimeout(()=>{r.remove()},3e3)}function mostrarResumen(){const e=document.querySelector(".contenido-resumen");for(;e.firstChild;)e.removeChild(e.firstChild);if(Object.values(cita).includes("")||0===cita.servicios.length)return void mostrarAlertas("Faltan datos de servicio, fecha y hora","error",".contenido-resumen",!1);const{nombre:t,fecha:o,hora:n,servicios:a}=cita,c=document.createElement("DIV");c.innerHTML='<h2>Resumen</h2> <p class="text-center">Verifica que tu informacion sea correcta</p>';const r=document.createElement("p");r.innerHTML="<span>Nombre: </span> "+t;const i=new Date(o),s=i.getMonth(),d=i.getDate()+2,l=i.getFullYear(),u=new Date(Date.UTC(l,s,d)).toLocaleDateString("es-MX",{weekday:"long",year:"numeric",month:"long",day:"numeric"}),m=document.createElement("p");m.innerHTML="<span>Fecha: </span> "+u;const p=document.createElement("p");p.innerHTML="<span>Hora: </span> "+n;const v=document.createElement("h2");v.textContent="Servicios",e.appendChild(c),e.appendChild(r),e.appendChild(m),e.appendChild(p),e.appendChild(v),a.forEach(t=>{const o=document.createElement("DIV");o.classList.add("contenedor-servicio");const n=document.createElement("p");n.textContent=t.nombre;const a=document.createElement("p");a.innerHTML="<span>Precio: </span> $"+t.precio,o.appendChild(n),o.appendChild(a),e.appendChild(o)});const h=document.createElement("button");h.classList.add("boton"),h.textContent="Reservar Cita",h.onclick=reservarCita,e.appendChild(h)}function reservarCita(){}document.addEventListener("DOMContentLoaded",()=>{iniciarApp()});