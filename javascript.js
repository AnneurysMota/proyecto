document.addEventListener("DOMContentLoaded", () => {
    // Manejo de formulario de clientes
    document.getElementById("clienteForm").addEventListener("submit", function (event) {
        event.preventDefault();
        let nombre = document.getElementById("nombre").value;
        let telefono = document.getElementById("telefono").value;
        let correo = document.getElementById("correo").value;

        if (nombre === "" || telefono === "" || correo === "") {
            alert("Todos los campos son obligatorios");
            return;
        }

        fetch("acciones.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ 
                accion: "agregar_cliente",  // Corregido
                nombre, 
                telefono, 
                correo  // Corregido
            })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            this.reset();
        })
        .catch(error => console.error("Error:", error));
    });

    // Manejo de formulario de vehículos
    document.getElementById("vehiculoForm").addEventListener("submit", function (event) {
        event.preventDefault();
        let id_cliente = document.getElementById("id_cliente").value; // Cliente asociado
        let marca = document.getElementById("marca").value;
        let modelo = document.getElementById("modelo").value;
        let anio = document.getElementById("anio").value; // Corregido
        let placa = document.getElementById("placa").value;

        if (id_cliente === "" || marca === "" || modelo === "" || anio === "" || placa === "") {
            alert("Todos los campos son obligatorios");
            return;
        }

        fetch("acciones.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: new URLSearchParams({ 
                accion: "agregar_vehiculo", // Corregido
                id_cliente,
                marca, 
                modelo, 
                anio,  // Corregido
                placa
            })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            this.reset();
        })
        .catch(error => console.error("Error:", error));
    });
});


