document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.attributes-group [data-attribute="duplicate"]')

    if(!buttons) return ;

    [...buttons].forEach((ele) => ele.addEventListener('click', (e) => addInput(e, ele)))
});

const addInput = (event, ele) => {
    // debugger
    event.preventDefault();
    event.stopPropagation();
    const inputs  = findInputs(event, ele);
    if(!inputs) return ;
    const groupBy = processGroupBy(inputs);
    Object.entries(groupBy).forEach(([key, value]) =>  {
        const current = value[0] ?? null;
        if (!current) return;
        const element    = current.closest('.attribute-input');
        const cloneInput = current.cloneNode(true);
        value.push(cloneInput);
        renameInputs(value);
        const container = document.createElement('div')
        container.appendChild(cloneInput)
        element.appendChild(container);
    })
}

const renameInputs = (inputs) => {
    inputs.forEach((input, k) => {
        let name = input.name
        const match = name.match(/(.*)\[(\d+)\]\[value\]\[(\d+)\]/)
        if (!!match) name = match[1] + '['+ match[2] +']' + '[value]';
        input.name = name + '['+ k +']';
    });
}

const findInputs = (event, ele) => {
    const {currentTarget} = event;
    const attributesContainer = ele.closest('#attributesContainer')
    const attributesGroup = currentTarget.closest('.attributes-group');
    const {attributeCode} = attributesGroup.dataset;
    return attributesContainer.querySelectorAll(`[data-id="${attributeCode}"] input[type=text]`)
}
const processGroupBy = (inputs) => {
    return [...inputs].reduce((acc, item) => {
        const {id} = item
        if (!Array.isArray(acc[id])) acc[id] = [];
        acc[id].push(item)
        return acc;
    }, {});
}
