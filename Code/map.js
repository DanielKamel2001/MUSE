/* Data points defined as an array of LatLng objects */
var heatmap;
async function getAddressess(){
    return new Promise(resolve =>{
        console.log("getting the addy")
        const request = new XMLHttpRequest();

        request.open("GET", "map.php");
        // request.responseType = 'text/javascript';
        request.send();

        request.onload = function() {
            const res = JSON.parse(request.response);
            console.log("hesrstheaddy",res)

             let points = getPoints(res);
            resolve(points);

        }
    });

}

// Heatmap data: 500 Points
function getPoints(addresses) {
    return new Promise(resolve => {

        let i = 0;
        // console.log("getting the p");
        const request = new XMLHttpRequest();

        let points = [];
        let aPoint;

        request.onload = function () {
            const res = JSON.parse(request.response);
            // console.log("p", points);
            aPoint =  (new google.maps.LatLng((res['results']['0']['geometry']['location']['lat']), (res['results']['0']['geometry']['location']['lng'])));
            console.log("aPoint");
            points[i] = aPoint;
            i++;
            if (i >= 300) {
                // console.log("sent", points);

                resolve( points);

            } else {
                replaced = (addresses[(i).toString()]['address']).split(' ').join('+');
                // console.log(replaced)
                request.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?address=" + replaced + "&bounds=56.931393," +
                    "-74.3206479|41.6765559,-95.1562271&key=____");
                request.send();
            }
        }

        let replaced;
        replaced = (addresses[(0).toString()]['address']).split(' ').join('+');
        // console.log(replaced)
        request.open("GET", "https://maps.googleapis.com/maps/api/geocode/json?address=" + replaced + "&key=___");
        request.send();


    });
}
async function initMap()
{

    var heatmapData = await getAddressess();


    var uniLocation = new google.maps.LatLng(43.945136, -78.894719);

    map = new google.maps.Map(document.getElementById('map'), {
        center:uniLocation,
        zoom: 13,
        mapTypeId: 'roadmap'
    });

    heatmap = new google.maps.visualization.HeatmapLayer({
        data: heatmapData
    });
    heatmap.setMap(map);

    //adds functions to buttons
    document
        .getElementById("toggle-heatmap")
        .addEventListener("click", toggleHeatmap);
    document
        .getElementById("change-gradient")
        .addEventListener("click", changeGradient);
    document
        .getElementById("change-opacity")
        .addEventListener("click", changeOpacity);
    document
        .getElementById("change-radius")
        .addEventListener("click", changeRadius);
}


function toggleHeatmap() {
    heatmap.setMap(heatmap.getMap() ? null : map);
    console.log("tog")
}

function changeGradient() {
    const gradient = [
        "rgba(0, 255, 255, 0)",
        "rgba(0, 255, 255, 1)",
        "rgba(0, 191, 255, 1)",
        "rgba(0, 127, 255, 1)",
        "rgba(0, 63, 255, 1)",
        "rgba(0, 0, 255, 1)",
        "rgba(0, 0, 223, 1)",
        "rgba(0, 0, 191, 1)",
        "rgba(0, 0, 159, 1)",
        "rgba(0, 0, 127, 1)",
        "rgba(63, 0, 91, 1)",
        "rgba(127, 0, 63, 1)",
        "rgba(191, 0, 31, 1)",
        "rgba(255, 0, 0, 1)",
    ];

    heatmap.set("gradient", heatmap.get("gradient") ? null : gradient);
}

function changeRadius() {
    heatmap.set("radius", heatmap.get("radius") ? null : 50);
}

function changeOpacity() {
    heatmap.set("opacity", heatmap.get("opacity") ? null : 1.0);
}