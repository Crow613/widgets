export default class FieldsUi{
    
    #blockClass = "";
    #iconClass = "";
    #textClass = ""
    #arrParams = [];
    fields = [];
    constructor({ blockClass, iconClass, textClass, arrParams })
    {
        this.#blockClass = blockClass;
        this.#iconClass = iconClass;
        this.#textClass = textClass;
        this.#arrParams = arrParams;        
        this.#createFields()
    }
    #createFields(){
       this.#arrParams.map(item => {
            this.fields.push(BX.create("div", {
                    props: { className: this.#blockClass },
                    children:[
                        BX.create("img", {
                            attrs: {
                                src:  item.icone,
                                alt: "Weather icon",
                                class: this.#iconClass
                            }
                        }),
                        BX.create("span",
                            {
                                props: {className:item.textClass},
                                text:item.text
                            }
                        )
                    ]
                }),
            )
        })        
        return this.fields;
    }
}