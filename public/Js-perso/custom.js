window.onload = () => {
        let groupe = document.querySelector("#seance_titre");
        let candidat = document.querySelector("#groupe_formation");
        if (groupe) {
             groupe.addEventListener("change", function () {
        let form = this.closest("form");
        let data = this.name + "=" + this.value;
            
        fetch(form.action, {
            method: form.getAttribute("method"),
            body: data,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
            }
        })
            .then(response => response.text())
            .then(html => {
                let content = document.createElement("html");
                content.innerHTML = html;
                let nouveauSelectgroupe = content.querySelector("#seance_groupe");
                document.querySelector("#seance_groupe").replaceWith(nouveauSelectgroupe);
            })
            .catch(error => {
                console.log(error);
            })
    });
        }
    //     if (candidat) {
    //     candidat.addEventListener("change", function () {
    //       let form = this.closest("form");
    //       let data = this.name + "=" + this.value;
  
    //       fetch(form.action, {
    //           method: form.getAttribute("method"),
    //           body: data,
    //           headers: {
    //               "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
    //           }
    //       })
    //           .then(response => response.text())
    //           .then(html => {
    //               let content = document.createElement("html");
    //               content.innerHTML = html;
    //               let nouveauSelect = content.querySelector("#groupe_candidats");
    //               document.querySelector("#groupe_candidats").replaceWith(nouveauSelect);
    //           })
    //           .catch(error => {
    //               console.log(error);
    //           })
    //   });
    //     }
        
       
  
}