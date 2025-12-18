class OptionManager {
    constructor() {
        this.popup = false;
        this.count = 0;
            this.userMenuButton = document?.querySelector('#user-block')
            this.#initEvents();
    }
    #initEvents() {
        this.userMenuButton.addEventListener('click', 
            ()=> setTimeout(()=>this.#createWidgetOptionsButton(), 1000))
    }
    async #createWidgetOptionsButton() {
        const  userMenuPopup = document?.querySelector('.ui-popupcomponentmaker__content')
        if (document.querySelector('.weather-option-btn')) return;

        const button = BX.create('button', {
            props:{className:'weather-option-btn'},
            text: "Options weather",
            events: {
                click: (e) =>{
                       this.count++
                    if (this.count > 1){
                        this.popup.close();
                        this.count = 0;
                        return
                    }
                    this.#createWidgetOptionsPopup(e)
                }
            }
        });
        (userMenuPopup.children.length >= 4) ?
            userMenuPopup.children[4].after(button):
            userMenuPopup.appendChild(button);
    }
    async #createWidgetOptionsPopup(e) {

        const content = BX.create("div", {
            props: {className: "weather-popup"},
            children: await this.#addElementPopup()
        });
            this.popup = BX.PopupWindowManager.create("weather-popup",
                e.target,
                {
                content: content,
                autoHide: true,
                lightShadow: true,
                offsetTop: -505,
                offsetLeft: -500,
                closeByEsc: true,
                angle: true
            });
            this.popup.show();
    }
    async #addElementPopup(){
       const  data = await this.#setRequest('getUserGroups');
        let arrElements = [];
        arrElements.push(
            BX.create("div", {
                props: {className: "weather-popup-item",name: 'switch'},
                children: [
                    BX.create("span", {
                    text:"показать/скрыть",
                    props: { name: 'switch' },
                    attrs: { className: 'field-label' }
                }),
                BX.create("select", {
                    props: { name: 'switch' },
                    attrs: { className: 'field-select' },
                    children: [
                        BX.create("option", { attrs: { value: "N", name:'check'}, text: "Скрыто" }),
                        BX.create("option", { attrs: { value: "Y", name:'check'}, text: "Видимо" })
                    ]
                })
            ]}))
        for (const dataKey in data) {
            const params = data[dataKey];
            arrElements.push( BX.create("div", {
                props: {className: "weather-popup-item", name: `${params.name}`},
                children: [
                    BX.create("span",
                        {text:`${params.name}`,
                            props: { name: `${params.name}` },
                            attrs: { className: 'field-label' }
                        }),
                    BX.create("select", {
                        props: { name: `${params.name}` },
                        attrs: { className: 'field-select' },
                        children: [
                            BX.create("option", { attrs: { value: "N" }, text: "Скрыто" }),
                            BX.create("option", { attrs: { value: `${params.sort}`}, text: "Видимо" })
                        ]
                    }),
                ]
            }))
        }
      arrElements.push(  BX.create("button", {
          text: "Сохранить",
          attrs: { className: 'btn-save' },
             props: {
                 onclick: () => this.#saveOptionsHandler(arrElements)
             }
        }))
        return arrElements;
    }
    async #saveOptionsHandler(forms) {
        let payload = {};

        for (const form of forms) {
            if (!form.children || form.children.length < 2) continue;

            const firstChild = form.children[0];
            const secondChild = form.children[1];

            const name = firstChild?.name;
            const value = secondChild?.value?.trim();

            if (!name || !value) continue;

            payload[name] = value;
        }
        try{
            const data =  await this.#setRequest('getOptionSave', payload);
          
            this.popup.close()
        }catch(e){
            console.error(e.message);
        }
    }
    async #setRequest(action, data = {}) {
        try {
            const response = await BX.ajax.runComponentAction('widgets:weather', action,
                {
                    mode: 'ajax',
                    data: {data:data}
                }
            );
            console.log(response);

            if (response.status !== "success")  throw new Error(response.message);
            return  response.data;
        } catch (e) {
            console.error('error get weather', e);
        }
    }
}

BX.ready(() => new OptionManager());
