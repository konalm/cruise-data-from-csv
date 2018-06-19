const apiUrl = `http://localhost:8001/api/public`

const app = document.getElementById('app');
const pageSize = 50;


/**
 * Inject Cruise into the DOM
 */
function injectCruisesIntoDOM(cruises) {
  app.innerHTML = '';

  cruises.forEach(function (cruise) {
    const cruiseLi = buildCruiseDomNode(cruise);
    app.appendChild(cruiseLi);
  });
}

/**
 * Add pagination Node's to the DOM
 */
function injectPaginationIntoDOM(count, activePage) {
  const pagination = document.getElementById('pagination');
  const pageCount = Math.ceil(parseInt(count) / pageSize)
  pagination.innerHTML = '';

  for (let x = 1; x <= pageCount; x++) {
    const page = buildPageDomNode(x, activePage)
    pagination.appendChild(page);
  }
}

/**
 * build page in pagination to be added to the DOM
 */
function buildPageDomNode(index, activePage) {
  let page = document.createElement("li");
  page.className = index === parseInt(activePage)
    ? 'page-item active'
    : 'page-item';

  const pageLink = `${window.location.origin}/?page=${index}`
  page.innerHTML = `<a class="page-link" href="${pageLink}"> ${index} </a>`
  return page;
}

/**
 * build Cruise data node to be added to the DOM
 */
function buildCruiseDomNode(cruise) {
  let cruiseLi = document.createElement("div");

  cruiseLi.innerHTML =
    `<div class="card mt-2">
      <div class="card-header"> ${cruise.offer_name} </div>

      <div class="card-body">
        <div class="card-body__left pr-4">
          <p> <b>Offer Name</b>: ${cruise.offer_name} </p>
          <p> <b>Departure Date:</b> ${cruise.departure_date} </p>
          <p> <b>Itinerary:</b> ${cruise.itinerary} </p>
        </div>

        <div class="card-body__right">
          <img src="/images/${cruise.cruise_line_logo}" />
        </div>
      </div>
    </div>`

  return cruiseLi
}

/**
 * Get the value of a querystring
 */
getQueryString = function (field, url) {
	const href = url ? url : window.location.href;
	const reg = new RegExp( `[?&]${field}=([^&#]*)`, 'i' );
	const string = reg.exec(href);

	return string ? string[1] : 1;
};


/**
 * get cruise data and inject it into DOM
 */
(function () {
  const activePage = getQueryString('page', window.location.href)
  var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const cruiseData = JSON.parse(this.responseText);

      injectCruisesIntoDOM(cruiseData.cruises);
      injectPaginationIntoDOM(cruiseData.cruises_count, activePage);
    }
  };

  xhttp.open("GET", `${apiUrl}/cruises?offset=${activePage}&limit=${pageSize}`, true);
  xhttp.send();
})()
