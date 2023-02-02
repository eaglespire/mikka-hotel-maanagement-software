import '../bootstrap';
import '../../css/app.css'
import ReactDOM from 'react-dom/client';
import Root from "./Root";
import {BrowserRouter} from "react-router-dom";

ReactDOM.createRoot(document.getElementById('newRole')).render(
    <BrowserRouter>
        <Root />
    </BrowserRouter>
);

