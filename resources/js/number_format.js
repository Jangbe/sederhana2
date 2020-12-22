import { isNumber } from "lodash";

export default function number_format(number = 0, decimals, dec_point = ',', thousands_point = '.') {

    if (number == null || !isNumber(number)) {
        throw new TypeError("number tidak valid");
    }

    if (!decimals) {
        var len = number.toString().split('.').length;
        decimals = len > 1 ? len : 0;
    }

    number = parseFloat(number).toFixed(decimals);

    number = number.replace(".", dec_point);

    var splitNum = number.split(dec_point);
    splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
    number = splitNum.join(dec_point);

    return number;
}
