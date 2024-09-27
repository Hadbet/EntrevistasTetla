function llenarNomina(nomina) {
    if (nomina.length === 1) {
        return nomina = "0000000" + nomina;
    }
    if (nomina.length === 2) {
        return nomina = "000000" + nomina;
    }
    if (nomina.length === 3) {
        return nomina = "00000" + nomina;
    }
    if (nomina.length === 4) {
        return nomina = "0000" + nomina;
    }
    if (nomina.length === 5) {
        return nomina = "000" + nomina;
    }
    if (nomina.length === 6) {
        return nomina = "00" + nomina;
    }
    if (nomina.length === 7) {
        return nomina = "0" + nomina;
    }
    return nomina;
}