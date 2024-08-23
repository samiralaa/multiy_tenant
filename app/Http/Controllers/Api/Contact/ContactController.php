<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use Domain\Entities\Contact;
use Domain\Repositories\ContactRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class ContactController extends Controller
{
    protected $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

   public function index()
    {
        $contacts = $this->contactRepository->findAll();
        return response()->json($contacts);
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Create a new Contact entity
        $contact = new Contact(
            0, // ID is not set for a new contact
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('message'),
            null, // created_at
            null  // updated_at
        );

        // Save the contact
        $this->contactRepository->save($contact);

        return response()->json(['message' => 'Contact created successfully'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified contact.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $contact = $this->contactRepository->findById($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($contact, Response::HTTP_OK);
    }

    /**
     * Update the specified contact in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        $contact = $this->contactRepository->findById($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }

        // Update the contact entity
        $contact = new Contact(
            $id,
            $request->input('name'),
            $request->input('email'),
            $request->input('phone'),
            $request->input('message'),
            $contact->getCreatedAt(), // Preserve original created_at
            new \DateTime() // Update updated_at
        );

        $this->contactRepository->save($contact);

        return response()->json(['message' => 'Contact updated successfully'], Response::HTTP_OK);
    }

    /**
     * Remove the specified contact from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $contact = $this->contactRepository->findById($id);

        if (!$contact) {
            return response()->json(['message' => 'Contact not found'], Response::HTTP_NOT_FOUND);
        }

        $this->contactRepository->delete($id);

        return response()->json(['message' => 'Contact deleted successfully'], Response::HTTP_NO_CONTENT);
    }
}
