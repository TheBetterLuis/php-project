<div class="search-bar-container">
    <form id="search-form" action="profiles.php" method="get">
        <input type="text" name="username" placeholder="Search for users..." required>
        <button type="submit">Search</button>
    </form>
</div>

<style>
.search-bar-container {
    margin: 20px 0;
    display: flex;
    justify-content: center;
}

#search-form {
    display: flex;
    align-items: center;
}

#search-form input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
    outline: none;
}

#search-form button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    background-color: #c82448;
    color: #fff;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
    outline: none;
}

#search-form button:hover {
    background-color: #a81b39;
}
</style>

