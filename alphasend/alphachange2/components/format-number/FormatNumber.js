function formatNumber(number, decimals) {
  if(number > 1) {
    let numStr = String(number);
    if (-1 !== numStr.indexOf('.')) {
      let parts = numStr.split('.');
      parts[1] = parts[1].slice(0, decimals);
      number = parts[0] + '.' + parts[1];
    }
  }
  return number;
}

export default formatNumber