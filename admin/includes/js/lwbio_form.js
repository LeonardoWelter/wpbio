setTimeout(function () {
    const formSelect = document.getElementById("lwbio_type");

    formSelect.addEventListener('change', (event) => {
        const result = event.target.value;
        showForm(result);
        console.log(result);
    });
}, 2000);

function showForm(form) {
    const link = document.getElementById("lwbio_form_link");
    const channel = document.getElementById("lwbio_form_channel");

    link.hidden = true;
    channel.hidden = true;

    if (form == "link") {
        link.hidden = false;
    } else if (form == "channel") {
        channel.hidden = false;
    }
}