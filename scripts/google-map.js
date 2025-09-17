// Initialize and add the map
let map;

async function initMap() {
  // The location of acolade kharadi
  const position = { lat: 18.546802, lng: 73.932618 };
  // Request needed libraries.
  //@ts-ignore 
  const { Map } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

  // The map, centered at Uluru
  map = new Map(document.getElementById("map"), {
    zoom: 12,
    center: position,
    mapId: "DEMO_MAP_ID",
  });

  // The marker, positioned at Uluru
  const marker = new AdvancedMarkerElement({
    map: map,
    position: position,
    title: "Uluru",
  });
}

initMap();



