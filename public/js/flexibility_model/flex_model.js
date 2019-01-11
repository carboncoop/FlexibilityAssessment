function immersion_heater() {
    var immersion_average_kw = 2.0;
    var immersion_availability = 0.8;
    return immersion_average_kw * immersion_availability;
}

function storage_heater(epc_rating) {
    var storage_heater_availability = epc_rating / 100.0;
    var storage_heater_average_kw = 1.5;
    var storage_heater_average_number = 1.5;
    return storage_heater_average_kw * storage_heater_availability * storage_heater_average_number;
}

function flex_model(flex_im_count, flex_im_score, flex_sh_count, flex_sh_score) {
    var immersion_weighting = immersion_heater(flex_im_score / flex_im_count);
    var storage_heater_weighting = storage_heater(flex_sh_score / flex_sh_count);

    return immersion_weighting * flex_im_count + storage_heater_weighting * flex_sh_count;
}
