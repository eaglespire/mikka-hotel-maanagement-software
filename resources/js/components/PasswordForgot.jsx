import ReactDOM from "react-dom/client";
import {useState} from 'react'
const PasswordForgot = () => {
    const [showMessage,setShowMessage] = useState(false)
    const onClickHandler = ()=>{
        setShowMessage(true)
    }
    const closeMessage = ()=>{
        setShowMessage(false)
    }
  return (
      <>
            <a onClick={onClickHandler} href="#"><i className="mdi mdi-lock"></i> Forgot your password?</a>
          {
              showMessage && (
                  <div className="p-3">
                      <div className="alert alert-primary alert-dismissible fade show">
                          <strong>Please kindly reach out to the administrator to reset your password!</strong>
                          <button type="button" className="close" onClick={closeMessage} aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                  </div>
              )
          }

      </>
  )
}
export default PasswordForgot

ReactDOM.createRoot(document.getElementById('forgot-password')).render(
    <PasswordForgot/>
)
