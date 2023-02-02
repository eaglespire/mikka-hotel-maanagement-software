import {useState} from "react";
import axios from "axios";

const Roles = ()=>{
    const [showForm,setShowForm] = useState(false)
    const [showBtn,setShowBtn] = useState(true)
    const [processing,setProcessing] = useState(null)
    const [success,setSuccess] = useState(null)
    const [showError,setShowError] = useState(null)
    const [formInput,setFormInput] = useState({name:''})
    const [disableSubmitBtn,setDisableSubmitBtn] = useState(true)

    const newRoleHandler = ()=> {
        setShowForm(true)
        setShowBtn(false)
    }
    const closeBtnHandler = ()=> {
        setShowForm(false)
        setShowBtn(true)
    }
    const inputChangeHandler = e=>{
        setFormInput({name: e.target.value})
        if (formInput.name.length >= 3){
            setDisableSubmitBtn(false)
        }else{
            setDisableSubmitBtn(true)
        }
    }
    const submitForm = (e)=>{
        e.preventDefault()
        setProcessing(true)
        axios.post('/api/roles',formInput)
            .then(response=>{
                console.log(response)
                setProcessing(false)
                setSuccess(true)
                setShowError(false)
                formInput.name = ""
            })
            .catch(error=>{
                setProcessing(false)
                console.log(error.response)
                if (error.response.status === 422){
                    setShowError(true)
                    return false
                }
            })
    }
    let newRoleForm = null
    if (showForm){
        newRoleForm = (
            <form onSubmit={(e)=>submitForm(e)}>
                {processing && <span className={'form-text'}>Please wait</span>}
                {success && (
                    <div className='alert alert-success alert-dismissible fade show'>
                        <strong>Success!</strong>
                        <button type="button" className="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                )}
                {showError && (
                    <div className='alert alert-danger alert-dismissible fade show'>
                        <strong>Error! Please check the data being sent or your internet connection</strong>
                        <button type="button" className="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                )}
                <div className="form-group">
                    <label className="form-label">Name</label>
                    <input value={formInput.name} onChange={(e)=>inputChangeHandler(e)} type="text" className="form-control"/>
                    <span className="form-text">{formInput.name}</span>
                </div>
                <button disabled={disableSubmitBtn} type='submit' className="btn btn-sm btn-primary mr-1">
                    <i className="fas fa-plus"></i> Submit
                </button>
                <button onClick={()=>closeBtnHandler()} className="btn btn-sm btn-secondary">
                    Close
                </button>
            </form>
        )
    }
    return (
        <>
            <div>
                {newRoleForm}

                { showBtn &&
                    <button onClick={newRoleHandler} className="btn btn-primary btn-block">
                        <i className="fas fa-plus"></i>
                        Add New Role
                    </button>
                }

                <div className="roles-menu">
                    <ul>
                        <li className="active">
                            <a href="#">Administrator</a>
                            <span className="role-action">
                                <a href="#">
                                    <span className="action-circle large">
                                        <i className="material-icons">edit</i>
                                    </span>
                                </a>
                                <a href="#">
                                    <span className="action-circle large delete-btn">
                                        <i className="material-icons">delete</i>
                                    </span>
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </>
    )
}
export default Roles
