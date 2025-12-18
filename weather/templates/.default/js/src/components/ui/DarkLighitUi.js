
const DarkLighitUi = {
    getForm(){
      return  BX.create("div", {
                         props: { className: 'weather-widget-dark-lighit-block' },
                         children: [
                               BX.create("button", {
                                props: {class: "weather-widget-lighit-btn", style:"display:none;"},
                                children:[
                                    BX.create("img", {
                                                            attrs: {
                                                                src:  'https://img.icons8.com/?size=100&id=dzi5TGZpsbP7&format=png&color=000000',
                                                                alt: "Weather icon",
                                                                class: "weather-widget-dark-icon"
                                                            }
                                                        })
                                ],
                                events:{ click:(e)=>this.eventHandler(e)}
                            }),
                            BX.create("button", {
                                props: { class: "weather-widget-dark-btn",  },
                                children:[
                                            BX.create("img", {
                                                    attrs: {
                                                        src:  'https://img.icons8.com/?size=100&id=45475&format=png&color=000000',
                                                        alt: "Weather icon",
                                                        class: "weather-widget-lighit-icon"
                                                    }
                                                }),
                                ],
                                events:{ click:(e)=>this.eventHandler(e)}
                            })
                        ]
                    });
    },
    eventHandler(form){
        const dark = form.target.offsetParent.firstChild.firstChild;
        const lighit = form.target.offsetParent.firstChild.lastChild;
        const weatherBlock = form.target.offsetParent;
        const titleBlock = weatherBlock.querySelector('.weather-title-block')
        const sun = weatherBlock.querySelector(".weather-icon");
        if(form.target.className === "weather-widget-dark-icon"){
            dark.style.display="none";
            lighit.style.display="";
            sun.style.display='';
            titleBlock.style.color="#031f40"
            weatherBlock.style.backgroundImage="url('/local/components/widgets/weather/templates/.default/image/background.png')";  
        }
        if(form.target.className === "weather-widget-lighit-icon"){
            dark.style.display="";
            lighit.style.display="none";
            sun.style.display='none';
            titleBlock.style.color="#98ABBE"
            titleBlock.style.justifyContent= "center";
            weatherBlock.style.backgroundImage="url('/local/components/widgets/weather/templates/.default/image/background_dark.png')";
        }
    }
}
export default DarkLighitUi;