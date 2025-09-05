import Articles from "./artikel/Articles";
import Events from "./comunity/Event";
import Features from "./home/Feature";
import Form from "./home/Form";
import Hero from "./home/Hero";
import Peta from "./home/Peta";

const Home = () => {
  return (
    <>
      <Hero />
      <Features />
      <Peta />
      <Form />
      <Events />
      <Articles />
    </>
  );
};

export default Home;
