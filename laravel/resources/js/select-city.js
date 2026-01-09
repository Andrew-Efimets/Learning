import Choices from 'choices.js';
import 'choices.js/public/assets/styles/choices.min.css';

window.Choices = Choices;
// Инициализация


const selectIds = ['city_id', 'category_id'];
const commonOptions = {
    noResultsText: 'Ничего не найдено',
    itemSelectText: 'Нажмите, чтобы выбрать',
    allowHTML: true,
    searchEnabled: true,
    shouldSort: false,
};

selectIds.forEach(id => {
    const element = document.getElementById(id);
    if (element) {
        new Choices(element, commonOptions);
    }
});
