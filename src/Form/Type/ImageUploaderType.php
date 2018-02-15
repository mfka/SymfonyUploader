<?php

namespace App\Form\Type;

use App\Model\Image as ImageModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class ImageUploaderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                    'attr' => ['placeholder' => 'Name of file'],
                    'constraints' => [new NotBlank(['message' => 'Name field can\'t be empty!'])],
                ]
            )
            ->add('file', FileType::class, [
                    'constraints' => new Image([])]
            )
            ->add('height', IntegerType::class, [
                    'attr' => ['min' => 0],
                    'constraints' => [new NotBlank(), new Range(['min' => 0, 'minMessage' => 'This Value could not be smaller then 0'])]
                ]
            )
            ->add('width', IntegerType::class, [
                    'attr' => ['min' => 0],
                    'constraints' => [new NotBlank(), new Range(['min' => 0, 'minMessage' => 'This Value could not be smaller then 0'])]
                ]
            )
            ->add('submit', SubmitType::class, ['label' => 'Upload']);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'error_bubbling' => true,
            'data_class' => ImageModel::class,
            'empty_data' => function (FormInterface $form) {
                $image = new ImageModel();
                $image->setName($form->get('name')->getData());
                $image->setFile($form->get('file')->getData());
                $image->setHeight($form->get('height')->getData());
                $image->setWidth($form->get('width')->getData());
                return $image;
            }
        ]);
    }
}