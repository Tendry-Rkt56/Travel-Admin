const port = window.location.port
const container = document.getElementById('container')
const loader = document.querySelector('.loader')


container.addEventListener('click', (e) => {
    if (e.target.closest('.menu')) {
        const element = e.target.closest('.menu')
        toggleOptions(element)
    }
})

function toggleOptions(element) {
    console.log(element)// Empêche le clic sur le menu de fermer le menu
    var optionsMenu = element.nextElementSibling
    console.log(optionsMenu)
    optionsMenu.style.display = optionsMenu.style.display === 'block' ? 'none' : 'block';
}

 // Fermer le menu si on clique en dehors
document.addEventListener('click', function(event) {
    var optionsMenus = document.querySelectorAll('.options');
    optionsMenus.forEach(function(menu) {
        if (!menu.contains(event.target) && event.target.className !== 'bx bx-dots-vertical-rounded') {
            menu.style.display = 'none';
        }
    });
});

async function recupData (search)
{
    try {
        const data = await fetch(`http://localhost:${port}/api/gallery/${search}`) 
        if (data.ok) {
            const response = await data.json()
            console.log(response)
            return response
        }
        else {
            throw new Error('Erreur lors de la recupération des données')
        }
    }
    catch(error) {
        console.log(error)
    }
}

async function loading () 
{
    loader.style.display = 'block'
    await new Promise(resolve => setTimeout(resolve, 500))
    loader.style.display = "none"
}

function createElement(type, properties)
{
    const element = document.createElement(type)
    for (const key in properties) {
        if (properties.hasOwnProperty(key)) {
            element[key] = properties[key]
        }
    }
    return element
}

async function filterData (data)
{
    container.innerHTML = ''
    await loading()
    data.forEach(element => {
        const galleryItem = document.createElement('div');
        galleryItem.className = 'gallery-item';

        // Ajouter l'image
        const img = document.createElement('img');
        img.src = element.chemin;
        img.className = 'image';
        galleryItem.appendChild(img);

        // Ajouter le menu
        const menu = document.createElement('div');
        menu.className = 'menu';
        menu.innerHTML = "<i class='bx bx-dots-vertical-rounded'></i>";
        galleryItem.appendChild(menu);

        // Ajouter les options
        const options = document.createElement('div');
        options.className = 'options';

        // Bouton pour supprimer
        const deleteForm = document.createElement('form');
        deleteForm.action = `/gallery/${element.id}`;
        deleteForm.method = 'POST';

        const deleteButton = document.createElement('button');
        deleteButton.type = 'submit';
        deleteButton.textContent = 'Supprimer';
        deleteForm.appendChild(deleteButton);
        options.appendChild(deleteForm);

        // Bouton pour remplacer
        const replaceButton = document.createElement('button');
        replaceButton.textContent = 'Remplacer';
        replaceButton.onclick = () => replaceImage(galerie.title);
        options.appendChild(replaceButton);

        galleryItem.appendChild(options);

        // Ajouter l'élément complet à la galerie
        container.appendChild(galleryItem);
    })
}

const input = document.getElementById("destination")
input.addEventListener('input', async (e) => {
    const value = e.target.value
    const data = await recupData(value)
    await filterData(data)
})

