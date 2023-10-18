$(document).ready(function() {
    var searchResults = $('#search-results');
    var searchInput = $('.input');

    searchInput.on('keyup', function() {
        var searchValue = $(this).val().trim();

        if (searchValue === '') {
            searchResults.empty();
        } else {
            $.ajax({
                url: '/search', // Update the URL to your Laravel route
                type: 'GET', // Change to POST or GET as needed
                data: { query: searchValue },
                dataType: 'json',
                success: function(data) {
                    searchResults.empty();

                    if (data.length > 0) {
                        $.each(data, function(index, result) {
                            // Customize the way you display search results here
                            var showResult = `
                                <a href="/posts/${result.id}" class="d-flex flex-row  justify-content-between align-items-center " style="text-decoration: none;">
                                    <div class=" hover:bg-slate-200 pt-2 pb-2 mt-0">${result.title}</div>
                                </a>
                            `;
                            searchResults.append(showResult);
                        });
                    } else {
                        // Display a message if no results were found
                        searchResults.text('No results found.');
                    }
                },
                error: function() {
                    // Handle any errors
                    searchResults.empty();
                }
            });
        }
    });

    // Add a click event listener to the document to close search results when clicking outside
    $(document).on('click', function(event) {
        if (!$(event.target).closest(searchResults).length && searchResults.is(':visible')) {
            searchResults.empty();
        }
    });
});