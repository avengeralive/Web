import FormDataHelper from "../../helpers/FormDataHelper";

function logError(message, parentProps = {}, data = {}) {
  const params = {
    message: message,
    props: JSON.stringify(parentProps),
    data: JSON.stringify(data),
    stacktrace: stackTrace(),
  };
  let queryParams = '';
  if(parentProps.hasOwnProperty('user')) {
    queryParams = '?token=' + parentProps.user.accessToken;
  }
  return fetch('http://b.alphachange.ru/api/endpoint/log-error' + queryParams, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: FormDataHelper.body(params),
      })
      .then((response) => response)
      .catch((err) => {});
}

function stackTrace() {
  const err = new Error();
  return err.stack;
}

export default logError