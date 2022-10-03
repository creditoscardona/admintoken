let aprueba = document.querySelector("#trueWallet");
let accounts;
let BDMContractToken;
let BDMContract;
let BDMContractWhitelist;
let accountToAprove;
let idUsuarioPlatform;

async function aprobarWallet() {
  console.log(idUsuarioPlatform);

  try {
    const result = await BDMContractWhitelist.methods
      .addToWhitelist([accountToAprove])
      .send({
        from: accounts[0],
      });
    console.log(result);
    if (result) {
      if (result.status) {
        let resultado = await axios.put(
          `https://apitoken.creditoscardona.com/useradmin/${idUsuarioPlatform}`,
          { whitelist: true },
          {
            "Content-Type": "application/json",
            headers: { "Access-Control-Allow-Origin": "*" },
          }
        );
        if (resultado.data) {
          swal(
            "Agregado a Whitelist",
            "El suaruio ha sido agregado a la whitelist correctamente",
            "success"
          );
        } else {
          swal(
            "Agregado",
            "El suaruio ha sido agregado a la whitelist correctamente, debe actualizarlo en la BASE DE DATOS",
            "info"
          );
        }
      } else {
        swal(
          "Es una lastima",
          "Ha ocurrido un error, intente nuevamente",
          "error"
        );
      }
    } else {
      swal(
        "Es una lastima",
        "Ha ocurrido un error, intente nuevamente",
        "error"
      );
    }
  } catch (e) {
    swal("Es una lastima", "Ha ocurrido un error, intente nuevamente", "error");
  }
  // console.log(BDMContractWhitelist)
  // console.log(BDMContract)
  // console.log(BDMContractToken)
}

aprueba.addEventListener("click", function (evento) {
  console.log("presionado aprobar");
  aprobarWallet();
});

$(document).ready(async function () {
  let contenido = document.querySelector("#contenido");
  let contenidoUsers = document.querySelector("#contenidoUsers");
  let result = await axios.get(
    "https://apitoken.creditoscardona.com/usersolwl"
  );

  let web3;
  let abiToken;
  let abiCrowdsale;
  let abiWhitelist;

  $.getJSON("Crowdsale.json", function (data) {
    // console.log(data)
    abiCrowdsale = data.abi;
    //do stuff with your data here
  });
  $.getJSON("STOToken.json", function (data) {
    // console.log(data)
    abiToken = data.abi;
    //do stuff with your data here
  });
  $.getJSON("WhitelistVault.json", function (data) {
    // console.log(data)
    abiWhitelist = data.abi;
    //do stuff with your data here
  });
  if (window.ethereum) {
    web3 = new Web3(window.ethereum);
    let provedor = window.ethereum;

    let chaId = await web3.eth.net.getId();

    if (chaId === 80001) {
      BDMContractToken = new web3.eth.Contract(
        abiToken,
        "0x4abA5897696335Ad45C1E712f7Ac66394C39f5DE"
      );
      BDMContract = new web3.eth.Contract(
        abiCrowdsale,
        "0xfa033E806058cbb7a67E95E22378f9262f9Cf7C0"
      );
      BDMContractWhitelist = new web3.eth.Contract(
        abiWhitelist,
        "0x760817B8077CEeda01B9A5D59cf8586b64C724eF"
      );
    } else {
      ///Aqui colocar el # contrato de main en todos
      BDMContractToken = new web3.eth.Contract(
        abiToken,
        "0x4abA5897696335Ad45C1E712f7Ac66394C39f5DE"
      );
      BDMContract = new web3.eth.Contract(
        abiCrowdsale,
        "0xfa033E806058cbb7a67E95E22378f9262f9Cf7C0"
      );
      BDMContractWhitelist = new web3.eth.Contract(
        abiWhitelist,
        "0x760817B8077CEeda01B9A5D59cf8586b64C724eF"
      );
    }

    try {
      // Request account access if needed
      await window.ethereum.request({
        method: "eth_requestAccounts",
      });

      accounts = await web3.eth.getAccounts();
      // Acccounts now exposed
      // dispatch(obtenerWeb3Action(web3));
      // dispatch(obtenerProvedorAction(provedor));
      // dispatch(obtenerContractAction(BDMContract));
      // dispatch(obtenerContractToken01Action(BDMContractToken));
      // let acts = await web3.eth.getAccounts();
      // let chId = await web3.eth.net.getId();
      // dispatch(obtenerAccountsAction(acts));
      // dispatch(obtenerChainIdAction(chId));
    } catch (error) {
      console.log(error);
    }
  } else if (window.web3) {
    // Legacy dapp browsers...
    // Use Mist/MetaMask's provider.
    web3 = window.web3;

    // dispatch(obtenerWeb3Action(web3));
    // let acts = await web3.eth.getAccounts();
    // let chId = await web3.eth.net.getId();
    // dispatch(obtenerAccountsAction(acts));
    // dispatch(obtenerChainIdAction(chId));
    //   dispatch(obtenerProvedorAction(provedor));
  } else {
    // Fallback to localhost; use dev console port by default...
    const provider = new Web3.providers.HttpProvider("http://127.0.0.1:8545");
    web3 = new Web3(provider);
    console.log("No web3 instance injected, using Local web3.");
    // dispatch(obtenerWeb3Action(web3));
    // dispatch(obtenerProvedorAction(provider));
    // let acts = await web3.eth.getAccounts();
    // let chId = await web3.eth.net.getId();
    // dispatch(obtenerAccountsAction(acts));
    // dispatch(obtenerChainIdAction(chId));
  }

  console.log("web3: ", web3);
  // console.log(result.data)

  for (let valor of result.data) {
    contenido.innerHTML += `
          <tr>
        <th>${valor.nombres}</th>
        <th>${valor.apellidos}</th>
        <th>${valor.kycComplete === true ? "Completo" : "Incompleto"}</th>
        <th>${valor.wallet}</th>
        <th style="display: none">${valor.id}</th>
        <th style="display: none">${JSON.stringify(valor.datosFinancieros)}</th>
        <th style="display: none">${JSON.stringify(valor.datosPersonales)}</th>
        <th style="display: none">${JSON.stringify(valor.urlConfirmacion)}</th>
        </tr>
          `;
  }

  let resultUsers = await axios.get(
    "https://apitoken.creditoscardona.com/users"
  );

  for (let valor of resultUsers.data) {
    contenidoUsers.innerHTML += `
          <tr>
        <th>${valor.nombres}</th>
        <th>${valor.apellidos}</th>
        <th>${valor.wallet}</th>
        <th style="display: none">${valor.id}</th>
        <th style="display: none">${JSON.stringify(valor.datosFinancieros)}</th>
        <th style="display: none">${JSON.stringify(valor.datosPersonales)}</th>
        <th style="display: none">${JSON.stringify(valor.urlConfirmacion)}</th>
        </tr>
          `;
  }
  //   var table = $("#example").DataTable();

  var table = $("#theTable").DataTable({
    // ajax: '/get_data.php',
    responsive: true,
  });

  var tableUsers = $("#theTableUsers").DataTable({
    // ajax: '/get_data.php',
    responsive: true,
  });

  $("#theTable tbody").on("click", "tr", function () {
    let myrow = table.row($(this)).data();
    // console.log(myrow)

    let cuatro;
    let cinco;
    let seis;
    let siete;
    let ocho;
    let nueve;
    let diez;

    switch (JSON.parse(myrow[5]).cuarta) {
      case "1":
        cuatro = "Menos del 25%";
        break;
      case "2":
        cuatro = "Entre el 25 y 50%";
        break;
      case "3":
        cuatro = "Entre el 50 y 75%";
        break;
      case "4":
        cuatro = "Más del 75%";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[5]).quinta) {
      case "1":
        cinco = "No tengo ingresos periodicos";
        break;
      case "2":
        cinco = "Prestacion por jubiacion o incapacidad";
        break;
      case "3":
        cinco = "Actividad Laboral";
        break;
      case "4":
        cinco = "Rentas de bienes inmuebles en propiedad";
        break;
      case "5":
        cinco = "Rendimiento de inversiones financieras";
        break;
      default:
        break;
    }

    switch (JSON.parse(myrow[5]).sexta) {
      case "1":
        seis = "Recolocar inversiones financieras existentes";
        break;
      case "2":
        seis = "Herencia o donación";
        break;
      case "3":
        seis = "Ingresos por negocios";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[5]).septima) {
      case "1":
        siete = "Menos de 6 meses";
        break;
      case "2":
        siete = "Entre 6 meses y 2 años";
        break;
      case "3":
        siete = "Entre 2 y 5 años";
        break;
      case "4":
        siete = "Mas de 5 años";

      default:
        break;
    }

    switch (JSON.parse(myrow[5]).octava) {
      case "1":
        ocho =
          "Mi objetivo es preservar el capital invertido y no estoy dispuesto a asumir riesgos";
        break;
      case "2":
        ocho =
          "Estoy dispuesto a asumir fluctuaciones moderadas de mi capital invertido";
        break;
      case "3":
        ocho =
          "Estoy dispuesto a asumir fluctuaciones elevadas de mi capital invertido";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[5]).novena) {
      case "1":
        nueve = "Preservar el capital";
        break;
      case "2":
        nueve = "Crecimiento medio del capital, asumiendo un riesgo moderado";
        break;
      case "3":
        nueve = "Crecimiento fuerte del capital asumiendo fuertes riesgos";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[5]).decima) {
      case "1":
        diez = "No tengo estudios";
        break;
      case "2":
        diez = "Estudios basicos";
        break;
      case "3":
        diez = "Estudios superiores";
      case "4":
        diez = "Estudios superiores o postgrado en materia financiera";
        break;

      default:
        break;
    }
    // craft modal body
    $("#name").html(myrow[0]);
    $("#lastname").html(myrow[1]);
    accountToAprove = myrow[3];
    idUsuarioPlatform = myrow[4];
    $("#birthday").html(JSON.parse(myrow[6]).nacimiento);
    $("#address").html(JSON.parse(myrow[6]).direccion);
    $("#ind").html(JSON.parse(myrow[6]).indicativo);
    $("#phone").html(JSON.parse(myrow[6]).celular);
    $("#city").html(JSON.parse(myrow[6]).ciudad);
    $("#region").html(JSON.parse(myrow[6]).region);
    $("#zip").html(JSON.parse(myrow[6]).zip);
    $("#cityzenship").html(JSON.parse(myrow[6]).nacionalidad);
    $("#primera").html(JSON.parse(myrow[5]).primera === "1" ? "Si" : "No");
    $("#segunda").html(JSON.parse(myrow[5]).segunda === "1" ? "Si" : "No");
    $("#tercera").html(JSON.parse(myrow[5]).tercera === "1" ? "Si" : "No");
    $("#cuarta").html(cuatro);
    $("#quinta").html(cinco);
    $("#sexta").html(seis);
    $("#septima").html(siete);
    $("#octava").html(ocho);
    $("#novena").html(nueve);
    $("#decima").html(diez);
    $("#once").html(JSON.parse(myrow[5]).once);
    $("#doce").html(JSON.parse(myrow[5]).doce);
    $("#imgCedula").attr("src", JSON.parse(myrow[7]).urlImgAnverso);
    $("#imgCedulaR").attr("src", JSON.parse(myrow[7]).urlImgReverso);
    $("#imgSelfie").attr("src", JSON.parse(myrow[7]).urlImgSelfie);
    $("#modalData").modal("show");
  });

  $("#theTableUsers tbody").on("click", "tr", function () {
    let myrow = tableUsers.row($(this)).data();
    // console.log(myrow)

    let cuatro;
    let cinco;
    let seis;
    let siete;
    let ocho;
    let nueve;
    let diez;

    switch (JSON.parse(myrow[4]).cuarta) {
      case "1":
        cuatro = "Menos del 25%";
        break;
      case "2":
        cuatro = "Entre el 25 y 50%";
        break;
      case "3":
        cuatro = "Entre el 50 y 75%";
        break;
      case "4":
        cuatro = "Más del 75%";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[4]).quinta) {
      case "1":
        cinco = "No tengo ingresos periodicos";
        break;
      case "2":
        cinco = "Prestacion por jubiacion o incapacidad";
        break;
      case "3":
        cinco = "Actividad Laboral";
        break;
      case "4":
        cinco = "Rentas de bienes inmuebles en propiedad";
        break;
      case "5":
        cinco = "Rendimiento de inversiones financieras";
        break;
      default:
        break;
    }

    switch (JSON.parse(myrow[4]).sexta) {
      case "1":
        seis = "Recolocar inversiones financieras existentes";
        break;
      case "2":
        seis = "Herencia o donación";
        break;
      case "3":
        seis = "Ingresos por negocios";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[4]).septima) {
      case "1":
        siete = "Menos de 6 meses";
        break;
      case "2":
        siete = "Entre 6 meses y 2 años";
        break;
      case "3":
        siete = "Entre 2 y 5 años";
        break;
      case "4":
        siete = "Mas de 5 años";

      default:
        break;
    }

    switch (JSON.parse(myrow[4]).octava) {
      case "1":
        ocho =
          "Mi objetivo es preservar el capital invertido y no estoy dispuesto a asumir riesgos";
        break;
      case "2":
        ocho =
          "Estoy dispuesto a asumir fluctuaciones moderadas de mi capital invertido";
        break;
      case "3":
        ocho =
          "Estoy dispuesto a asumir fluctuaciones elevadas de mi capital invertido";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[4]).novena) {
      case "1":
        nueve = "Preservar el capital";
        break;
      case "2":
        nueve = "Crecimiento medio del capital, asumiendo un riesgo moderado";
        break;
      case "3":
        nueve = "Crecimiento fuerte del capital asumiendo fuertes riesgos";
        break;

      default:
        break;
    }

    switch (JSON.parse(myrow[4]).decima) {
      case "1":
        diez = "No tengo estudios";
        break;
      case "2":
        diez = "Estudios basicos";
        break;
      case "3":
        diez = "Estudios superiores";
      case "4":
        diez = "Estudios superiores o postgrado en materia financiera";
        break;

      default:
        break;
    }
    // craft modal body
    $("#nameUsers").html(myrow[0]);
    $("#lastnameUsers").html(myrow[1]);
    idUsuarioPlatform = myrow[3];
    $("#birthdayUsers").html(JSON.parse(myrow[5]).nacimiento);
    $("#addressUsers").html(JSON.parse(myrow[5]).direccion);
    $("#indUsers").html(JSON.parse(myrow[5]).indicativo);
    $("#phoneUsers").html(JSON.parse(myrow[5]).celular);
    $("#cityUsers").html(JSON.parse(myrow[5]).ciudad);
    $("#regionUsers").html(JSON.parse(myrow[5]).region);
    $("#zipUsers").html(JSON.parse(myrow[5]).zip);
    $("#cityzenshipUsers").html(JSON.parse(myrow[5]).nacionalidad);
    $("#primeraUsers").html(JSON.parse(myrow[4]).primera === "1" ? "Si" : "No");
    $("#segundaUsers").html(JSON.parse(myrow[4]).segunda === "1" ? "Si" : "No");
    $("#tercerUsersa").html(JSON.parse(myrow[4]).tercera === "1" ? "Si" : "No");
    $("#cuartaUsers").html(cuatro);
    $("#quintaUsers").html(cinco);
    $("#sextaUsers").html(seis);
    $("#septimaUsers").html(siete);
    $("#octavaUsers").html(ocho);
    $("#novenaUsers").html(nueve);
    $("#decimaUsers").html(diez);
    $("#onceUsers").html(JSON.parse(myrow[4]).once);
    $("#doceUsers").html(JSON.parse(myrow[4]).doce);
    $("#imgCedulaUsers").attr("src", JSON.parse(myrow[6]).urlImgAnverso);
    $("#imgCedulaRUsers").attr("src", JSON.parse(myrow[6]).urlImgReverso);
    $("#imgSelfieUsers").attr("src", JSON.parse(myrow[6]).urlImgSelfie);
    $("#modalDataUsers").modal("show");
  });
});
