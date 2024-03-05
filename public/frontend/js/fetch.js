	    let url = 'https://jgarcor257.ieszaidinvergeles.es/TrabajoPuntuable/tienda/public/show';
	    let imgurl = 'https://jgarcor257.ieszaidinvergeles.es/TrabajoPuntuable/tienda/public/storage/';
	    let imgicon = 'https://jgarcor257.ieszaidinvergeles.es/TrabajoPuntuable/tienda/public/';
	    let paginaActual = 1;
		let filterLinks = document.querySelectorAll('.filter-link');
	
	    function cargarProductos(pagina,genero = '*', perPage = document.getElementById('perPageSelect').value, searchTerm = '', priceRange = '*') {
	        
            let fetchUrl = `${url}?page=${pagina}&per_page=${perPage}&genero=${genero}&precio=${priceRange}`;
		    if (searchTerm) {
		        fetchUrl += `&search=${encodeURIComponent(searchTerm)}`;
		    }
	        
	        fetch(fetchUrl, {
	            method: 'GET',
	            headers: {
	                'Content-Type': 'application/json',
	                'Accept': 'application/json'
	            }
	        })
	        .then(response => response.json())
			.then(data => {
			    console.log(data);
			    let productosDiv = document.getElementById('productos');
			    productosDiv.innerHTML = ''; 
			    let filaHTML = '<div class="row">';
			    data.data.forEach((producto, index) => {
			        let productoHTML = `
			            <div class="col-6 col-md-3 col-lg-3 isotope-item women">
			                <div class="block2">
			                    <div class="block2-pic hov-img0">
			                        <img class="" src="${imgurl+producto.imagen}" alt="product">
									<a href="#!" onclick="agregarAlCarrito({nombre: '${producto.nombre}', precio: ${producto.precio}, imagen: '${producto.imagen}'})" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								    Añadir Producto
								</a>
			                    </div>
			                    <div class="block2-txt flex-w flex-t p-t-14">
			                        <div class="block2-txt-child1 flex-col-l ">
			                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
			                                ${producto.nombre}
			                            </a>
			                            <span class="stext-105 cl3">
			                                ${producto.precio}€
			                            </span>
			                        </div>
			                        <div class="block2-txt-child2 flex-r p-t-3">
			                            <a href="#!" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
										<img class="icon-heart1 dis-block trans-04" src="${imgicon}/frontend/images/icons/icon-heart-01.png" alt="ICON">
										<img class="icon-heart2 dis-block trans-04 ab-t-l" src="${imgicon}/frontend/images/icons/icon-heart-02.png" alt="ICON">
			                            </a>
			                        </div>
			                    </div>
			                </div>
			            </div>
			        `;
			        filaHTML += productoHTML;

			        if ((index + 1) % 4 === 0 || index === data.data.length - 1) {
			            filaHTML += '</div>';
			            productosDiv.innerHTML += filaHTML;
			            filaHTML = '<div class="row">'; 
			        }
			    });
	            // Actualizar la página actual
	            paginaActual = data.current_page;
	
	            // Actualizar la paginación
	            actualizarPaginacion(data);
	            productosDiv.style.height = 'auto';
	            actualizarInfoPaginacion(data);
	        })
	        .catch(error => console.error("Error:", error));
	    }
	
	    function actualizarPaginacion(data) {
	        let paginacionDiv = document.getElementById('paginacion');
	        let html = `
			<nav class="d-flex justify-content-center mb-5 mt-5" aria-label="page navigation">
			    <ul class="pagination">
			        ${data.prev_page_url ? `<li class="page-item"><a class="page-arrow" href="#" onclick="cargarProductos(${data.current_page - 1}); return false;" aria-label="Previous"><span aria-hidden="true">
			            <i class="fa-solid fa-angle-left fa-lg" style="font-size: 1.75em;;margin-top:1rem;margin-right:1rem"></i>
			        </span><span class="sr-only">Previous</span></a></li>` : ''}
			        ${Array.from({length: data.last_page}, (_, i) => `
			            <li class="page-item ${data.current_page === i + 1 ? 'active' : ''}"><a class="page-link mx-1" href="#" onclick="cargarProductos(${i + 1}); return false;">${i + 1}</a></li>
			        `).join('')}
			        ${data.next_page_url ? `<li class="page-item"><a class="page-arrow" href="#" onclick="cargarProductos(${data.current_page + 1}); return false;" aria-label="Next"><span aria-hidden="true">
			            <i class="fa-solid fa-angle-right fa-lg" style="font-size: 1.75em;margin-top:1rem;margin-left:1rem"></i>
			        </span><span class="sr-only">Next</span></a></li>` : ''}
			    </ul>
			</nav>
	        `;
	        paginacionDiv.innerHTML = html;
	    }
	    
	    function actualizarInfoPaginacion(data) {
		    let paginationRange = document.getElementById('paginationRange');
		    let totalProducts = document.getElementById('totalProducts');
		
		    let fromIndex = (data.current_page - 1) * data.per_page + 1;
		    let toIndex = Math.min(data.current_page * data.per_page, data.total);
		
		    paginationRange.textContent = `${fromIndex}-${toIndex}`;
		    totalProducts.textContent = data.total;
		}
	
	    document.getElementById('perPageSelect').addEventListener('change', function() {
	    	
	        cargarProductos(paginaActual, this.value);
	    });
	
	function init() {
	    cargarProductos();
	}
	
	document.addEventListener('DOMContentLoaded', init);
	
	//Realizamos nueva busqueda al cambiar el valor del desplegable
	
	document.getElementById('perPageSelect').addEventListener('change', function() {
	    let perPage = this.value; 
	    cargarProductos(paginaActual, '*', perPage); 
	});

	
	document.getElementById('search-product').addEventListener('keydown', function (event) {
	    if (event.key === 'Enter') {
	        event.preventDefault(); // Evitar que el formulario se envíe por defecto
	        let searchTerm = this.value; // Obtener el término de búsqueda del input
	        cargarProductos(paginaActual, '*', perPage, searchTerm); // Cargar productos con el término de búsqueda
	    }
	});
	
	filterLinks.forEach(link => {
	    link.addEventListener('click', function(event) {
	        event.preventDefault(); 
	        let priceRange = this.getAttribute('data-price-range');
	        console.log(priceRange);
	        cargarProductos(paginaActual, '*', document.getElementById('perPageSelect').value, '', priceRange);
	    });
	});