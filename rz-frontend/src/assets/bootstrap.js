import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"
import "bootstrap-icons/font/bootstrap-icons.css"

const env = import.meta.env
window.env = env

import 'vue3-toastify/dist/index.css';
import { toast } from 'vue3-toastify';
window.toast = toast;