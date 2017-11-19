
var kahawa = {lat: 52.409663, lng: 16.924642};
var placeObject = {"location" : kahawa, "placeId" : "ChIJg8-c4TdbBEcROZyhFicrWFI"};
var styles = [
    {
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#ff4400"
            },
            {
                "saturation": -68
            },
            {
                "lightness": -4
            },
            {
                "gamma": 0.72
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon"
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry",
        "stylers": [
            {
                "hue": "#0077ff"
            },
            {
                "gamma": 3.1
            }
        ]
    },
    {
        "featureType": "water",
        "stylers": [
            {
                "hue": "#00ccff"
            },
            {
                "gamma": 0.44
            },
            {
                "saturation": -33
            }
        ]
    },
    {
        "featureType": "poi.park",
        "stylers": [
            {
                "hue": "#44ff00"
            },
            {
                "saturation": -23
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "hue": "#007fff"
            },
            {
                "gamma": 0.77
            },
            {
                "saturation": 65
            },
            {
                "lightness": 99
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "gamma": 0.11
            },
            {
                "weight": 5.6
            },
            {
                "saturation": 99
            },
            {
                "hue": "#0091ff"
            },
            {
                "lightness": -86
            }
        ]
    },
    {
        "featureType": "transit.line",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": -48
            },
            {
                "hue": "#ff5e00"
            },
            {
                "gamma": 1.2
            },
            {
                "saturation": -23
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "saturation": -64
            },
            {
                "hue": "#ff9100"
            },
            {
                "lightness": 16
            },
            {
                "gamma": 0.47
            },
            {
                "weight": 2.7
            }
        ]
    }
]

function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: kahawa,
        styles: styles
    });
    var marker = new google.maps.Marker({
        position: kahawa,
        map: map,
        place: placeObject,
        title: "KAHAWA Kawa i Książka"
    });
}

document.addEventListener("DOMContentLoaded", function(){
    var cartPage = document.querySelector('.woocommerce-cart');
    if (cartPage) {
        var barArea = document.getElementById('content').getElementsByClassName('col-full')[0];
        var barToMove = document.querySelector('#content>.col-full>.woocommerce');
        if (barToMove) {
            var barToInsert = barToMove.cloneNode(true);
            var entryContent = document.getElementById('main').getElementsByClassName('entry-content')[0];
            var contentFirstChild = entryContent.children[0];
            entryContent.insertBefore(barToInsert, contentFirstChild);
            barArea.removeChild(barToMove);
        }
    }
    
    var eventsPage = document.querySelector('.page-template-wydarzenie-archive');
    var mainPage = document.querySelector('.page-template-template-main');
    if (eventsPage || mainPage) {
        var description = document.querySelectorAll('.wydarzenie-details');
        var height = 0;
        console.log(description);
        for (var i = 0; i < description.length; i++) {
            if (description[i].offsetHeight > height) {
                height = description[i].offsetHeight;
            }
        }
        var style = 'height: '+height+'px';
        for (var j = 0; j < description.length; j++) {
            description[j].setAttribute('style', style);
        }
    }
});