@vite('resources/css/modules/add-product.css')
@vite('resources/js/filters.js')

<div id="profile-add-good-cont-overlay">
    <div id="profile-add-good-cont">
        <div id="profile-add-good-cont-close">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5A5A5A"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
        </div>
        <p id="profile-add-good-cont-title">Add product</p>
        <form method="POST" action="/profile/add-good/add-good-auth" enctype="multipart/form-data">
            @csrf
            <label>Choose the photo:</label>
            <input type="file" name="image">
            <div class="profile-add-good-cont-input">
                <input type="text" name="name" id="profile-add-good-cont-form-name" placeholder=" ">
                <label for="profile-add-good-cont-form-name">Name</label>
            </div>
            <div class="profile-add-good-cont-input">
                <textarea name="description" id="profile-add-good-cont-form-description" placeholder=" "></textarea>
                <label for="profile-add-good-cont-form-description">Description</label>
            </div>
            <div class="profile-add-good-cont-input">
                <input type="number" name="price" id="profile-add-good-cont-form-price" placeholder=" ">
                <label for="profile-add-good-cont-form-price">Price $</label>
            </div>
            <p>Filters:</p>
            <div id="selected-filters-container"></div>
            <input type="hidden" name="filters" id="hidden-filters-input">
            <div class="profile-add-good-cont-input">
                <select id="profile-add-good-cont-form-filters">
                    <option value="choose" selected disabled>Choose a filter</option>
                    <option value="rofl">Rofl</option>
                    <option value="technique">Technique</option>
                    <option value="clothes">Clothes</option>
                </select>
            </div>
            <button type="submit">Add</button>
        </form>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const closeBtn = document.getElementById('profile-add-good-cont-close');
        const addGoodCont = document.getElementById('profile-add-good-cont-overlay');
    
        closeBtn.addEventListener('click', function() {
                addGoodCont.style.display = 'none';
        });

        document.addEventListener('keydown', function() {
            if (event.key === "Escape") {
                addGoodCont.style.display = 'none';
            }
        });
    });
</script>