// console.log('OK');

// get "section" object
let section = document.getElementById("section");

function displayArticles(articles) {
    console.log(articles);
    for (let content of articles) {

        let div = document.createElement("div");
        div.classList.add("col-12", "col-sm-6", "col-lg-3", "my-2");

        section.appendChild(div);
        let article = document.createElement("article");
        article.classList.add("card", "h-100");

        div.appendChild(article);
        let h = document.createElement("h4");
        h.classList.add("card-title", "text-center");
        h.innerText = content.titre;
        article.appendChild(h);

        let p = document.createElement("p");
        p.classList.add("card-text", "text-center");
        p.innerText = content.contenu;
        article.appendChild(p);
    }
}

// Load articles from https://oc-jswebsrv.herokuapp.com/api/articles
function loadContent() {
    httpRequest = new XMLHttpRequest();

    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let articles = JSON.parse(httpRequest.responseText);
                displayArticles(articles);
            } else {
                alert("Une erreur est survenue");
            }
        }
    };

    httpRequest.open('GET', 'https://oc-jswebsrv.herokuapp.com/api/articles', true);
    httpRequest.send();
}
loadContent();