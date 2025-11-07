@vite('resources/css/modules/profile/your-products.css')

<form method="POST" action="{{ route('profile.your-products.filter') }}" id="profile-right-cont-filters">
    @csrf
    <label for="profile-right-cont-select-filter">Filter:</label>
    <select name="select_filter" id="profile-right-cont-select-filter">
        <option value="asc">By data(asc)</option>
        <option value="desc">By data(desc)</option>
        <option value="technique">Technique</option>
        <option value="clothes">Clothes</option>
        <option value="rofl">Rofl</option>
    </select>
    <button type="submit">Filter</button>
</form>
<div id="profile-your-products">
    @foreach ($products as $product)
        @include('modules.profile.product-card', ['product' => $product])
    @endforeach
</div>
