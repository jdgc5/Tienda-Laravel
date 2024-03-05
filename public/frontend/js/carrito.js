let carrito = []; 
let totalElement = document.getElementById('totalAmount'); 

function agregarAlCarrito(producto, event) {
    carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.push(producto);
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarNotificacionCarrito(carrito.length);
    actualizarTotal();
    actualizarItemsCarrito(producto);
    event.preventDefault();
}

window.addEventListener('load', function() {
    carrito = JSON.parse(localStorage.getItem('carrito')) || []; 
    actualizarNotificacionCarrito(carrito.length);
    actualizarItemsCarrito();
    actualizarTotal();
});

function actualizarNotificacionCarrito(cantidad) {
    document.querySelector('.js-show-cart').setAttribute('data-notify', cantidad);
}

function limpiarCarrito() {
    localStorage.removeItem('carrito');
    carrito = []; 
    actualizarNotificacionCarrito(0);
    totalElement.textContent = '0.00'; 
    actualizarItemsCarrito()
}

function total() {
    let total = 0;
    for (let producto of carrito) {
        total += producto.precio;
    }
    return total.toFixed(2);
}

function actualizarTotal() {
    totalElement.textContent = total();
}


function actualizarItemsCarrito() {
    let imgurl = 'https://jgarcor257.ieszaidinvergeles.es/TrabajoPuntuable/tienda/public/storage/';
    let carrito = JSON.parse(localStorage.getItem('carrito')) || []; // Obtener el carrito actualizado
    let carritoItemsContenedor = document.getElementById('carritoItemsContenedor');
    carritoItemsContenedor.innerHTML = ''; // Limpiar el contenido anterior del contenedor

    carrito.forEach((producto, index) => {
        let nuevoItemCarrito = document.createElement('li');
        nuevoItemCarrito.classList.add('header-cart-item');
        nuevoItemCarrito.classList.add('flex-w');
        nuevoItemCarrito.classList.add('flex-t');
        nuevoItemCarrito.classList.add('m-b-12');
        
        // Crear el enlace y agregarle el ID y el evento onclick
        let enlaceImagen = document.createElement('a');
        enlaceImagen.href = '#!';
        enlaceImagen.id = `imagen-${index}`;
        enlaceImagen.onclick = function(event) {
            event.stopPropagation();
            eliminarArticulo(index);
        };

        // Crear el contenedor para la imagen
        let contenedorImagen = document.createElement('div');
        contenedorImagen.classList.add('header-cart-item-img');

        // Agregar la imagen al contenedor
        let imagen = document.createElement('img');
        imagen.src = `${imgurl+producto.imagen}`;
        imagen.alt = 'IMG';
        contenedorImagen.appendChild(imagen);

        // Agregar el contenedor al enlace
        enlaceImagen.appendChild(contenedorImagen);

        // Agregar el enlace al ítem del carrito
        nuevoItemCarrito.appendChild(enlaceImagen);

        // Agregar el resto del contenido del ítem del carrito
        let textoCarrito = document.createElement('div');
        textoCarrito.classList.add('header-cart-item-txt');
        textoCarrito.classList.add('p-t-8');
        textoCarrito.innerHTML = `
            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                ${producto.nombre}
            </a>
            <span class="header-cart-item-info">
                1 x $${producto.precio.toFixed(2)}
            </span>
        `;
        nuevoItemCarrito.appendChild(textoCarrito);

        // Agregar el ítem del carrito al contenedor principal
        carritoItemsContenedor.appendChild(nuevoItemCarrito);
        actualizarTotal();
        actualizarNotificacionCarrito(carrito.length);
        
    });
}


function eliminarArticulo(index) {
    carrito.splice(index, 1); 
    localStorage.setItem('carrito', JSON.stringify(carrito)); 
    actualizarItemsCarrito(); 
}

