const ViewDoc = document.querySelector("#ViewDoc");

function LoadDoc(e){
    var origin = window.location.origin;

    clean("#NomDoc");
    clean("#tableDocument");

    const NomDoc = document.querySelector("#NomDoc");
    const tableDocument = document.querySelector("#tableDocument");

    let htmlNom = "";
    htmlNom += `
    <tr>
        <th scope="col" class="px-6 py-3">${e.value}</th>
    </tr>
    `;
    NomDoc.innerHTML = htmlNom;

    let htmlDoc = "";
    htmlDoc += `
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="px-6 py-4">
            <iframe src="${origin}/storage/data/${e.id}/${e.value}" style="width:100%; height:700px;" frameborder="0"></iframe>
        </td>
    </tr>
    `;
    
    tableDocument.innerHTML = htmlDoc;

    ViewDoc.removeAttribute("hidden");
}

function HideDoc(){
    clean("#NomDoc");
    clean("#tableDocument");
    ViewDoc.setAttribute("hidden", "true");
}

function clean(cleanHtml) {
    const aux = document.querySelector(cleanHtml);
    while (aux.firstChild) {
        aux.removeChild(aux.firstChild);
    }
}