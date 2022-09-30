export default class View {
  _data;

  render(data) {
    if (!data || (Array.isArray(data) && data.length === 0))
      return this.renderError();
    this._data = data;
    const markup = this._generateMarkup();
 
    this._parentElement.insertAdjacentHTML("afterbegin", markup);
  }

  _clear() {
    this._parentElement.innerHTML = "";
  }

  renderError(message = this._errorMessage) {
    const markup = `
        <div class="error">
          <img src="public/img/icons/icon-error.png" alt="icon-error" class="error__icon">
          <p class="error__message">${message}</p>
        </div>
      `;
    this._clear();
    this._parentElement.insertAdjacentHTML("afterbegin", markup);
  }
}
