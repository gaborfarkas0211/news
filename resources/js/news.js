import TomSelect from 'tom-select';
import 'tom-select/dist/css/tom-select.bootstrap5.css';
let settings = {
    maxItems: 5,
    maxOptions: null
}
new TomSelect('#country', settings);
new TomSelect('#category', settings);
new TomSelect('#language', settings);
