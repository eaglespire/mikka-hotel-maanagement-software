import ReactDOM from "react-dom/client";

const Greeting = (props) => {
    console.log(props.fullname)
    const greetMe = ()=>{
        const d = new Date();
        const time = d.getHours();
        return (time < 12) ? `Good morning, ${props.fullname} !` : ((time <= 18 && time >= 12) ? `Good afternoon, ${props.fullname} !` : `Good evening, ${props.fullname} !`);
    }
  return (
      <>
          <h3>{greetMe()}</h3>
      </>
  )
}
export default Greeting

const element = document.getElementById('greeting');
const props = Object.assign({},element.dataset)

ReactDOM.createRoot(element).render(
    <Greeting {...props}/>
)
