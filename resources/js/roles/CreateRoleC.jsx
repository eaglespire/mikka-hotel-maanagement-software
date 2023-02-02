import {Link} from "react-router-dom";
import axios from "axios";
import {useState} from "react";


const CreateRole = ()=> {
    const [successText,setSuccessText] = useState(null)
    const [name,setName] = useState({name:''})
    const handleChange = (e)=> {
        setName({name:e.target.value})
    }
    const submitHandler = (e)=>{
        e.preventDefault()
        axios.post('/api/roles',name)
            .then(response=>{
                console.log(response)
                setSuccessText("Success h")
            })
            .catch(error=>{
                console.log(error)
            })
    }
    let pText = null;
    if (successText !== ""){
        pText = <div className={'alert alert-success'}>{successText}</div>
    }
    console.log(name)
    return (
        <>
            <div className="row">
                <div className="col-6">
                    <h4 className="page-title">Add Role</h4>
                </div>
                <div className="col-6">
                    <Link to={'/mikka/role-permissions'} className="btn btn-sm btn-primary">Go Back</Link>
                </div>
            </div>
            <div className="row">
                <div className="col-12">
                    <form>
                        {pText}
                        <div className="form-group">
                            <label>Role Name <span className="text-danger">*</span></label>
                            <input onChange={(e)=>handleChange(e)} className="form-control" type="text"/>
                        </div>
                        <div className="m-t-20 text-center">
                            <button onClick={(e)=>submitHandler(e)} className="btn btn-primary submit-btn">Create Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </>
    )
}
export default CreateRole
