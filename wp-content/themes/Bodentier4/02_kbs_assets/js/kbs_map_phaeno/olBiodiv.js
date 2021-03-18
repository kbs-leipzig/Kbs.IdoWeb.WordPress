var map;
var vectorSource;
var mapStyles;
var geoJsonStyles;
var vectorLayer;

function addVectorPointLayer(mapObject) {

	vectorSource = new ol.source.Vector();

	vectorLayer = new ol.layer.Vector({
		source: vectorSource,
		style: mapStyles
	});

	mapObject.addLayer(vectorLayer);
}

function styleFunction(feature, resolution) {
	return geoJsonStyles[feature.getGeometry().getType()];
};

function setMarker(lat, lng) {

	vectorSource.clear();
	vectorSource.addFeature(new ol.Feature(new ol.geom.Point(ol.proj.transform([lng, lat], 'EPSG:4326', 'EPSG:3857'))));
	map.getView().setCenter(ol.proj.transform([lng, lat], 'EPSG:4326', 'EPSG:3857'));

}

function initMap(mapId, lat, lng) {


	
	mapStyles = new ol.style.Style({
		image: new ol.style.Icon(({ src: olStyleBase + '/Images/pin.png' })),
		fill: new ol.style.Fill({ color: 'rgba(255, 255, 255, 0.6)' }),
		stroke: new ol.style.Stroke({color: 'blue',width: 3}),
	});

	geoJsonStyles = { 'Point': [mapStyles] };

	var tkLayer = new ol.layer.Tile({
		source: new ol.source.TileWMS({
			url: configGetPostgisHost,
			params: { 'LAYERS': 'tkraster', 'TILED': true },
			serverType: 'mapserver',
			
		})
	});

	var borderLayer = new ol.layer.Tile({
		source: new ol.source.TileWMS( /** @type {olx.source.TileWMSOptions} */ ({
			url: 'https://wms.kbs-leipzig.de/cgi-bin/verwaltungsgrenzen_get',
			params: { 'LAYERS': 'bundeslaender', 'TILED': true, 'SRS': 'EPSG:4326' },
			projection: 'EPSG:3857',
	})),
		
	});

	 
	//var jsonSource = new ol.source.ServerVector({
	//	format: new ol.format.GeoJSON(),
	//	loader: function (extent, resolution, projection) {
	//		$.ajax({
	//			url: olServiceBase + '/BiodivGeo.svc/GetAdvices',
	//			data: { speciesId: 120513, extent: ol.proj.transformExtent(extent, 'EPSG:3857', 'EPSG:4326').join(',') },
	//			success: function (data) {
	//				jsonSource.addFeatures(jsonSource.readFeatures(data));
	//			}
	//		});
	//	},
	//	projection: 'EPSG:3857',
	//	strategy: ol.loadingstrategy.bbox
	//});

	//var jsonLayer = new ol.layer.Vector({
	//	style: new ol.style.Style({
	//		image: new ol.style.Circle({
	//			radius: 3,
	//			fill: new ol.style.Fill({ color: 'green' })
	//		})
	//	}),
	//	source: jsonSource,
	//});

	map = new ol.Map({
		target: mapId,
		controls: ol.control.defaults().extend([
			new ol.control.ScaleLine({
				units: 'metric'
			})
		]),
		layers: [
		  new ol.layer.Tile({
		  	source: new ol.source.BingMaps({ culture: 'de-DE', key: olBingApiKey, imagerySet: 'AerialWithLabels' })
		  }), borderLayer
		],
		view: new ol.View({
			center: ol.proj.transform([lng, lat], 'EPSG:4326', 'EPSG:3857'),
			zoom: 12,
			maxZoom: 19
		}),

	});

	addVectorPointLayer(map);
	//setMarker(lat,lng);

	return map;
}
