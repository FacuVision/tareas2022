let parameters = []
let tipoPregunta = ""

function removeElement(event, position) {
    event.target.parentElement.remove()
    delete parameters[position]
}

const addJsonElement = json => {
    parameters.push(json)
    return parameters.length - 1
}

(function load() {
    const $form = document.getElementById("frmActividad")

    const $FormFinal = document.getElementById("FormFinal")

    const $divElements = document.getElementById("divElements")
    const $btnSave = document.getElementById("btnSave")
    const $btnAdd = document.getElementById("btnAdd")

    const templateElement = (data, position) => {
        return (`
            <button class="delete" onclick="removeElement(event, ${position})"></button>
            <strong>Actividad - </strong> ${data}
        `)
    }

    $btnAdd.addEventListener("click", (event) => {
        if ($form.descripcion.value != "" && !isNaN($form.puntaje_max.value) && $form.puntaje_max.value != "" && $form.puntaje_max.value > 0 && $form.puntaje_max.value <= 20) {
            let index = addJsonElement({
                descripcion: $form.descripcion.value,
                recurso: $form.recurso.value,
                puntaje_max: $form.puntaje_max.value,
                tipo: $form.tipo.value,
            })

            const $div = document.createElement("div")
            $div.classList.add("notification", "is-link", "is-light", "py-2", "my-1")

            switch ($form.tipo.value) {
                case "0":
                    tipoPregunta = "Respuesta corta"
                    break;
                case "1":
                    tipoPregunta = "Respuesta larga"
                    break;
                case "2":
                    tipoPregunta = "Link de Video"
                    break;
                case "3":
                    tipoPregunta = "Link de carpeta de Drive"
                    break;
            }

            $div.innerHTML = templateElement(`<strong>Descripcion:</strong> ${$form.descripcion.value} <br><strong>Recurso:</strong> ${$form.recurso.value} <br><strong>Puntaje Max:</strong> ${$form.puntaje_max.value} <br><strong>Tipo de pregunta:</strong> ${tipoPregunta}`, index)

            $divElements.append($div)

            $form.reset()
        } else {

            if ($form.puntaje_max.value>20) {
                alert("Solo puntajes mayores que 0 y menores que 20")
            } else{
                alert("Rellene los campos necesarios")
            }
        }
    })

    $btnSave.addEventListener("click", (event) => {
        parameters = parameters.filter(el => el != null)
        const $jsonDiv = document.getElementById("jsonDiv")
        document.getElementById("hiden_json").value = `${JSON.stringify(parameters)}`

        $divElements.innerHTML = ""
        parameters = []

        $FormFinal.submit()
    })

})()
