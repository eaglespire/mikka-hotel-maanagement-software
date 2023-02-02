import ReactDOM from "react-dom/client";
import {HashRouter,Routes,Route} from "react-router-dom";
import Rooms from "./Rooms";
import AddRoom from "./AddRoom";
const Main = () => {
      return (
          <Routes>
              <Route element={<Rooms/>} path='/'/>
              <Route element={<AddRoom/>} path='/rooms/create' />
          </Routes>
      )
}
export default Main

ReactDOM.createRoot(document.getElementById('room-component')).render(
    <HashRouter>
        <Main/>
    </HashRouter>
)



