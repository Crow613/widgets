const DataTimeUi = {
    getForm(data){
        return  BX.create("div", {
                  props: { className: 'weather-widget-time-block' },
                  children: [
                  BX.create("img", {
                        attrs: {
                            src:  '/local/components/widgets/weather/templates/.default/image/icons/sun.svg',
                            alt: "Weather icon",
                            class: "weather-icon"
                        }
                    }),
                 
                    BX.create("p", {
                        props: { className: 'weather-widget-data-subtitle' },
                        text: `дата: ${data.data}`,
                        style: { fontWeight: 'bold'}
                    }),
                    BX.create("p", {
                        props: { className: 'weather-widget-time-subtitle' },
                        text: `время: ${data.time}`,
                        style: { fontWeight: 'bold' }
                    }),
                ]
            })
    }
}
export default DataTimeUi;