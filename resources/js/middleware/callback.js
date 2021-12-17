import axios from 'axios'

export default async (to, from, next) => {
    try {
        const { data } = await axios.post(`http://localhost:8000/api/auth${to.fullPath}`)
        localStorage.setItem('Authorization', `Bearer ${data.access_token}`)
        next({ name: 'Home' })
    } catch (e) {
        next({ name: 'Login' })
    }
}
