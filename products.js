const productsPerPage = 20;
let currentPage = 1;
let cart = JSON.parse(localStorage.getItem('cart')) || [];

// Hiển thị số lượng trong giỏ
updateCartCount();

// Main: tải và hiển thị sản phẩm
async function displayProducts() {
    const searchQuery = document.getElementById("search").value.toLowerCase();

    // Gọi API đã sửa tên action thành list_products
    const response = await fetch('api.php?action=list_products');
    const products = await response.json();

    // Lọc theo từ khóa
    const filtered = products.filter(p =>
        p.name.toLowerCase().includes(searchQuery)
    );

    // Tính phân trang
    const start = (currentPage - 1) * productsPerPage;
    const paginated = filtered.slice(start, start + productsPerPage);

    // Build HTML
    const container = document.getElementById("product-container");
    container.innerHTML = paginated.map(p => `
        <div class="product-item">
            <a href="product-detail.php?id=${p.id}">
                <img src="${p.image_url || 'placeholder.jpg'}" alt="${p.name}" loading="lazy">
            </a>
            <h3>${p.name}</h3>
            <p>${Number(p.price).toLocaleString()} VND</p>
            <button class="btn" onclick="addToCart(${p.id}, '${p.name}', ${p.price})">
                Thêm vào giỏ hàng
            </button>
        </div>
    `).join('');

    displayPagination(filtered.length);
}

// Vẽ thanh phân trang
function displayPagination(totalItems) {
    const totalPages = Math.ceil(totalItems / productsPerPage);
    const pagContainer = document.getElementById("pagination");
    let html = '';

    for (let i = 1; i <= totalPages; i++) {
        html += `<button 
                    class="${i === currentPage ? 'active' : ''}" 
                    onclick="changePage(${i})">
                    ${i}
                 </button>`;
    }
    pagContainer.innerHTML = html;
}

// Chuyển trang
function changePage(page) {
    currentPage = page;
    displayProducts();
    window.scrollTo(0, 0);
}

// Khi nhập search, reset về trang 1
document.getElementById("search")
    .addEventListener("input", () => {
        currentPage = 1;
        displayProducts();
    });

// Thêm vào giỏ
function addToCart(id, name, price) {
    const idx = cart.findIndex(item => item.id === id);
    if (idx > -1) {
        cart[idx].qty += 1;
    } else {
        cart.push({ id, name, price, qty: 1 });
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartCount();
}

// Cập nhật badge giỏ hàng
function updateCartCount() {
    const count = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById("cart-count");
    if (badge) badge.textContent = count;
}

// Khởi chạy lần đầu
displayProducts();