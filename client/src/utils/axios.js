import axios from 'axios'

const instanceAxios = axios.create({
    baseURL: 'http://localhost:85/validator.php',
    timeout: 10000,
})

export default instanceAxios