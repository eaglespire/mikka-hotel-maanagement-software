import {Routes,Route} from 'react-router-dom'
import Roles from "./Roles";
import CreateRole from "./CreateRole";
const Root = ()=>{
    return (
        <Routes>
            <Route element={<Roles/>} path='/mikka/role-permissions' />
            <Route element={<CreateRole/>} path='/mikka/role-permissions/create' />
        </Routes>
    )
}
export default Root
