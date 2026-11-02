/**
 * Filter an array of people by a search term on name or last_name (case-insensitive).
 *
 * @param {Array<{name: string, last_name: string}>} people
 * @param {string} term
 * @returns {Array}
 */
function filterByName(people, term) {
  var needle = term.toLowerCase();

  return people.filter(function (item) {
    return item.last_name.toLowerCase().includes(needle) || item.name.toLowerCase().includes(needle);
  });
}

// Example: filterByName(myArr, 'hus');
