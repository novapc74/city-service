import axios from "axios";

export default function maps() {
    const mapWrapper = document.getElementById('map')
    if (mapWrapper) {
        if (typeof ymaps === 'object') {
            ymaps.ready(function () {
                // const mapWrapper = document.querySelector('.geography-section__map'),
                //     iconPath = mapWrapper.dataset.icon;

                const map = new ymaps.Map("map", {
                    center: mapWrapper.dataset.coords.split(','),
                    controls: [],
                    zoom: 15
                });

                map.behaviors.disable('scrollZoom')

                const address = new ymaps.Placemark(
                    mapWrapper.dataset.coords.split(','),
                    {},
                    {
                        iconLayout: "default#image",
                        // iconImageHref: iconPath,
                        // iconImageOffset: [-20, -60],
                        // iconImageSize: [38, 38]
                    }
                )

                map.geoObjects.add(address);
            });
        }
    }
}