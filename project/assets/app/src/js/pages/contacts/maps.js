import axios from "axios";

export default function maps() {
    const mapWrapper = document.getElementById('map')
    if (mapWrapper) {
        if (typeof ymaps === 'object') {
            ymaps.ready(function () {
                const iconPath = mapWrapper.dataset.icon;

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
                        iconImageHref: iconPath,
                        iconImageSize: [50, 50]
                    }
                )

                map.geoObjects.add(address);
            });
        }
    }
}